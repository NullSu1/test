<?php
$sql = "SELECT a.`product_options`,a.`sku`,b.`increment_id`,a.`updated_at` FROM `sales_order_item` as a left join `sales_order_grid` as b on a.`order_id`=b.`entity_id` where a.`product_type` != 'configurable' and a.sku REGEXP ('^KBH|^K(.*)YP|^BUNDLE|^KSSY|^KBC|^KENS|^KJBA') ";
