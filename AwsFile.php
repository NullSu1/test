<?php

/**
 * 本地不存文件，上传至aws新地址
 */
class AwsFile
{
    public $config = array(
        'region' => 'us-east-1',
        'bucket' => 'www-karativa-com',
        'accesskey' => 'AKIA2SFOWF3V7QAZTHWG',
        'secretkey' => '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'
    );
    public $filePath;
    public $uploadPath;
    public $pathPre = '';

    public function doUpload()
    {
        $file = file_get_contents($this->filePath);
        $uploadRes = $this->aws_s3_upload($this->uploadPath, $file);
        return $uploadRes;
    }

    public function aws_s3_upload($key, $body, $addition_headers = array())
    {
        $config['s3'] = $this->config;

        $service = 's3';
        $endpoint = 'http://s3.amazonaws.com/' . $config['s3']['bucket'] . $this->pathPre . $key;
        $endpoint = str_replace('\\', '/', $endpoint);
        $method = 'PUT';
        $region = $config['s3']['region'];
        $access_key = $config['s3']['accesskey'];
        $secret_key = $config['s3']['secretkey'];

        $headers = array();
        $headers['Content-Type'] = 'application/octet-stream';
        $headers['x-amz-content-sha256'] = hash('sha256', $body);
        $headers['x-amz-acl'] = 'public-read';

        foreach ($addition_headers as $k => $v) {
            $headers[$k] = $v;
        }

        list($code, $txt) = $this->aws_api($access_key, $secret_key, $region, $service, $endpoint, $body, $method, $headers);
        if ($code == 200) return true;

        return false;
    }

    public function aws_api($access_key, $secret_key, $region, $service, $endpoint, $body = '', $method = 'GET', $headers = array())
    {
        // Authorization header
        // add the date header
        $date = new DateTime('UTC');
        $headers['X-AMZ-Date'] = $date->format('Ymd\THis\Z');

        // if the Algorithm isn't already set, use the default
        $algorithm = 'AWS4-HMAC-SHA256';

        // Task 1: Canonical Request
        $canonical_request = array();

        // 1) HTTP method - they're all POST
        $canonical_request[] = $method;

        // 2) CanonicalURI
        $uri = parse_url(rtrim($endpoint), PHP_URL_PATH);

        // if there is no path, use /
        if ($uri == '') $uri = '/';

        // and URL encode it
        $uri = rawurlencode($uri);

        // but restore the /'s
        $uri = str_replace('%2F', '/', $uri);

        // 2) URI
        $canonical_request[] = $uri;

        // 3) CanonicalQueryString
        parse_str(parse_url(rtrim($endpoint), PHP_URL_QUERY), $qs_arr);
        uksort($qs_arr, 'strcmp');
        $canonical_request[] = http_build_query($qs_arr);

        // 4) CanonicalHeaders
        $can_headers = array('host' => parse_url($endpoint, PHP_URL_HOST));
        foreach ($headers as $k => $v) {
            $can_headers[strtolower($k)] = trim($v);
        }

        // sort them
        uksort($can_headers, 'strcmp');

        // add them to the string
        foreach ($can_headers as $k => $v) {
            $canonical_request[] = $k . ':' . $v;
        }

        // add a blank entry so we end up with an extra line break
        $canonical_request[] = '';

        // 5) SignedHeaders - seriously, what the fuck, amazon?
        $canonical_request[] = implode(';', array_keys($can_headers));

        // 6) Payload
        // figure out which algorithm we're using
        $alg = substr(strtolower($algorithm), strlen('AWS4-HMAC-'));      // trim 'aws4-hmac-'
        $canonical_request[] = hash($alg, $body);
        $canonical_request = implode("\n", $canonical_request);


        // Task 2: String to Sign
        $string = array();

        // 1) Algorithm
        $string[] = $algorithm;

        // 2) RequestDate
        $string[] = $date->format('Ymd\THis\Z');

        // 3) CredentialScope
        $scope = array($date->format('Ymd'));

        $scope[] = $region;
        $scope[] = $service;
        $scope[] = 'aws4_request';              // this is one of the stupidest things i've ever heard of
        $string[] = implode('/', $scope);

        // 4) CanonicalRequest
        $string[] = hash($alg, $canonical_request);
        $string = implode("\n", $string);


        // Task 3: Signature
        // 1) HMACs
        $kSecret = 'AWS4' . $secret_key;
        $kDate = hash_hmac($alg, $date->format('Ymd'), $kSecret, true);             // remember, binary!
        $kRegion = hash_hmac($alg, $region, $kDate, true);
        $kService = hash_hmac($alg, $service, $kRegion, true);
        $kSigning = hash_hmac($alg, 'aws4_request', $kService, true);         // seriously, you're not securing anything amazon, just being a pain in the ass
        $signature = hash_hmac($alg, $string, $kSigning);             // the signature is the only part done in hex!


        // finally, for the bloody Authorization header
        $authorization = array(
            'Credential=' . $access_key . '/' . implode('/', $scope),
            'SignedHeaders=' . implode(';', array_keys($can_headers)),
            'Signature=' . $signature,
        );

        $authorization = $algorithm . ' ' . implode(',', $authorization);


        // POST
        $headers2 = array();
        $headers2[] = 'Authorization: ' . $authorization;
        $headers2[] = 'Host: ' . parse_url($endpoint, PHP_URL_HOST);
        foreach ($headers as $k => $v) {
            $headers2[] = $k . ': ' . $v;
        }
        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers2);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

        $response = curl_exec($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return array($retcode, $response);
    }
}