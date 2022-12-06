<?php
namespace export\controller;


class orderInfo extends DB
{

    private array $info;

    public function __construct(
        $db,
        $query_str,
        $info = []
    )
    {
        $this->info = $info;
        $this->query_str = $query_str;
        parent::__construct($db);
    }

    public function getField(){

        return [
            'OrderID',
            'OrderDate',
            'ProductSKU',
            'options',
            'ProductImage',
            'GiftSku',
            'GiftImage',
        ];
    }

    public function setPageSize(){

        return [
            '10',
            '20',
            '50',
            '100',
            '200',
            '500',
        ];
    }

    /**
     * @param $field
     * @return string
     */
    public function getQueryWhereFieldStr($field){
        if(empty($this->query_str)) return '';

        parse_str($this->query_str, $fields);
        if(in_array($field, array_keys($fields)))
            return addslashes($fields[$field]);
        return false;
    }

    /**
     * @return string
     */
    public function getQueryWhere(){
        $where = '';
        $start = $this->getQueryWhereFieldStr('start');
        $end = $this->getQueryWhereFieldStr('end');
        $search = $this->getQueryWhereFieldStr('search');
        if($start || $end){
            if(!$start){
                $where = " AND a.`created_at`<'$end'";
            }else if(!$end){
                $where = " AND a.`created_at`>'$start'";
            }else{
                $where = " AND (a.`created_at`>'$start' AND a.`created_at`<'$end')";
            }
        }
        if($search){
            $where .= " AND b.`increment_id` like '%$search%'";
        }
        return $where;
    }

    /**
     * @return string
     */
    public function getPagingLimit(){
        $page = (int)$this->getQueryWhereFieldStr('page');
        $pageSize = (int)$this->getQueryWhereFieldStr('pageSize');
        if(empty($pageSize))
            $pageSize = 20;
        $page = (!empty($page) && $page >= 1) ? ($page-1) : 0;
        $start = ($page)*$pageSize;
        return ' limit '.$start.','.$pageSize;
    }

    public function setInfo($info_buy){
        $this->info = $info_buy;
    }

    public function getInfo(){
        return $this->info;
    }

    public function getOrderInfo($check=''){
        $connect = $this->getDbConnect();
        if($connect){
            $query = $this->getQuery(
                '`sales_order_item` as a left join `sales_order_grid` as b on a.`order_id`=b.`entity_id`',
                'a.`product_options`,a.`sku`,b.`increment_id`,a.`created_at`,a.`parent_item_id`',
                "a.`product_type` != 'configurable'".$this->getQueryWhere(),
                "ORDER BY `a`.`created_at` DESC"
            );
            if($check == 'getNumber')
                return $connect->query($query)->num_rows;

            $query = $this->getQuery(
                '`sales_order_item` as a left join `sales_order_grid` as b on (a.`order_id`=b.`entity_id`)',
                'a.`product_options`,a.`sku`,a.`product_id`,b.`increment_id`,a.`created_at`,a.`parent_item_id`',
                "a.`product_type` != 'configurable'".$this->getQueryWhere(),
                "ORDER BY `a`.`created_at` DESC".$this->getPagingLimit()
            );
            if($connect->query($query)->num_rows > 0){
                $result = $connect->query($query);
                $array = [];
                while($item = $result->fetch_assoc()){
                    $this->setInfo($item);

                    $image = 'https://www.karativa.com/media/catalog/product'.$this->getImageById($item['product_id']);
                    if(!empty($this->getOptionsEncode())){
                        if ($this->getPreviewImg()) {
                            $image = $this->getPreviewImg();
                        }
                    }
                    $array[] = [
                        'OrderID'=>$item['increment_id'],
                        'OrderDate'=>$item['created_at'],
                        'SKU'=>$item['sku'],
                        'options'=>json_encode($this->getOptionsEncode()),
                        'image'=>$image,
                        'giftSku'=>$this->getGift()['sku'],
                        'giftImage'=>$this->getGift()['image']
                    ];
                }
                return $array;
            }
        }
        return false;
    }

    public function getOptionsEncode(){
        $info = json_decode($this->getInfo()['product_options'],true);
        $result = [];

        if(is_array($info['info_buyRequest'])){
            if(!empty($this->getInfo()['parent_item_id'])){
                $connect = $this->getDbConnect();
                $query = $this->getQuery(
                    '`sales_order_item`',
                    'product_options',
                    "item_id='".$this->getInfo()['parent_item_id']."'",
                );
                $info = $connect->query($query)->fetch_assoc();
                $attributes_info = json_decode($info['product_options'],true)['attributes_info'];
                if(in_array('super_attribute', array_keys($info['info_buyRequest']))){
                    $result[] = [$attributes_info[0]['label']=>$attributes_info[0]['value']];
                }
            }

            if (in_array('options', array_keys($info['info_buyRequest'])) && !empty($info['options'])) {
                foreach (array_keys($info['info_buyRequest']['options']) as $key) {
                    foreach ($info['options'] as $option) {
                        if ($key == $option['option_id']) {
                            $result[] = [$option['label'] => $option['value']];
                        }
                    }
                }
            }
        }
        return $result;
    }

    public function getGift(){
        $info = json_decode($this->getInfo()['product_options'],true);
        $result = [];
        if(!empty($info['info_buyRequest']) && is_array($info['info_buyRequest'])){
            if (in_array('fireegift', array_keys($info['info_buyRequest']))) {
                $giftInfo = json_decode(base64_decode($info['info_buyRequest']['fireegift']));
                $result = [
                    'image' => $giftInfo->image,
                    'sku' => ($giftInfo->sku ?? $giftInfo->name),
                ];
            }
        }
        return $result;
    }

    public function getImageById($id){
        $result = '';
        $connect = $this->getDbConnect();
        $query = $this->getQuery(
            "`catalog_product_entity` AS cpe LEFT JOIN `catalog_product_entity_varchar` AS cpev ON (cpe.entity_id=cpev.entity_id)",
            "cpe.sku,cpev.value",
            "cpe.entity_id = '$id' AND cpev.attribute_id='87'"
        );
        if($connect->query($query)->num_rows > 0):
            $result = $connect->query($query)->fetch_assoc();
        endif;
        if(empty($result)){
            $query = $this->getImageByChildQuery($id);
            if($connect->query($query)->num_rows > 0):
                $result = $connect->query($query)->fetch_assoc();
            endif;
        }
        return $result ? $result['value'] : '';
    }

    public function getImageByChildQuery($id){
        $query = $this->getQuery(
            "`catalog_product_entity` AS cpe LEFT JOIN `catalog_product_relation` AS cpr ON (cpe.entity_id = cpr.child_id) LEFT JOIN `catalog_product_entity_varchar` AS cpev ON (cpr.parent_id=cpev.entity_id)",
            "cpe.sku,cpev.value",
            "cpe.entity_id = '$id' AND cpev.attribute_id='87'"
        );
        return $query;
    }

    public function getPreviewImg(){
        $info = json_decode($this->getInfo()['product_options'],true);
        $info_buyRequest = $info['info_buyRequest'];
        $res = '';
        if(in_array('options',array_keys($info_buyRequest))){
            $product_id = $info_buyRequest['product'];
            $result = array_filter($info_buyRequest['options']);
            if(in_array('super_attribute',array_keys($info_buyRequest))){
                $result = array_filter($result + $info_buyRequest['super_attribute']);
            }
            ksort($result);
            $md5 = md5($product_id . json_encode($result, JSON_UNESCAPED_UNICODE));
            $url = "https://api.karativa.com/api/imagebase64magentotest?product_id=".$product_id."&md5=".$md5;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 500);
            $res = curl_exec($ch);
            curl_close($ch);
            return $res ? $url : false;
        }
        return false;
    }
}