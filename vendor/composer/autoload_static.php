<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit63427eb92e046f316fb861a74f7169aa
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        'c964ee0ededf28c96ebd9db5099ef910' => __DIR__ . '/..' . '/guzzlehttp/promises/src/functions_include.php',
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php',
        'd767e4fc2dc52fe66584ab8c6684783e' => __DIR__ . '/..' . '/adbario/php-dot-notation/src/helpers.php',
        'c65d09b6820da036953a371c8c73a9b1' => __DIR__ . '/..' . '/facebook/graph-sdk/src/Facebook/polyfills.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Http\\Client\\' => 16,
        ),
        'O' => 
        array (
            'OneSm\\' => 6,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
        ),
        'F' => 
        array (
            'Facebook\\' => 9,
        ),
        'D' => 
        array (
            'Darabonba\\OpenApi\\' => 18,
        ),
        'A' => 
        array (
            'AlibabaCloud\\Tea\\Utils\\' => 23,
            'AlibabaCloud\\Tea\\' => 17,
            'AlibabaCloud\\SDK\\Dm\\V20151123\\' => 30,
            'AlibabaCloud\\OpenApiUtil\\' => 25,
            'AlibabaCloud\\Endpoint\\' => 22,
            'AlibabaCloud\\Credentials\\' => 25,
            'Adbar\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Http\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-client/src',
        ),
        'OneSm\\' => 
        array (
            0 => __DIR__ . '/..' . '/lizhichao/one-sm/src',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/promises/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
        'Facebook\\' => 
        array (
            0 => __DIR__ . '/..' . '/facebook/graph-sdk/src/Facebook',
        ),
        'Darabonba\\OpenApi\\' => 
        array (
            0 => __DIR__ . '/..' . '/alibabacloud/darabonba-openapi/src',
        ),
        'AlibabaCloud\\Tea\\Utils\\' => 
        array (
            0 => __DIR__ . '/..' . '/alibabacloud/tea-utils/src',
        ),
        'AlibabaCloud\\Tea\\' => 
        array (
            0 => __DIR__ . '/..' . '/alibabacloud/tea/src',
        ),
        'AlibabaCloud\\SDK\\Dm\\V20151123\\' => 
        array (
            0 => __DIR__ . '/..' . '/alibabacloud/dm-20151123/src',
        ),
        'AlibabaCloud\\OpenApiUtil\\' => 
        array (
            0 => __DIR__ . '/..' . '/alibabacloud/openapi-util/src',
        ),
        'AlibabaCloud\\Endpoint\\' => 
        array (
            0 => __DIR__ . '/..' . '/alibabacloud/endpoint-util/src',
        ),
        'AlibabaCloud\\Credentials\\' => 
        array (
            0 => __DIR__ . '/..' . '/alibabacloud/credentials/src',
        ),
        'Adbar\\' => 
        array (
            0 => __DIR__ . '/..' . '/adbario/php-dot-notation/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit63427eb92e046f316fb861a74f7169aa::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit63427eb92e046f316fb861a74f7169aa::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
