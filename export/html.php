<html>
<head>
    <title>Karativa Order Export</title>
    <link rel="icon" href="static/image/title.png" type="image/x-icon">
    <link rel="stylesheet" href="static/css/index.css">
    <script language="javascript" type="text/javascript" src="static/js/WdatePicker.js"></script>
</head>
<body>
<div class="main">
    <div class="_box">
        <div class="export-button">
            <button><a href="export.php?<?= $_SERVER['QUERY_STRING']?>">export</a></button>
        </div>
        <div class="head-form">
            <form method="get">
                <input type="text" name="search" placeholder="search order ID" <?= $_GET['search'] ? "value='".$_GET['search']."'": ""; ?>/>
                <select name="pageSize">
                    <?php foreach ($order_Info->setPageSize() as $item): ?>
                        <option value="<?= $item; ?>" <?= $_GET['pageSize']==$item ? 'selected' : '';?>><?= $item; ?></option>
                    <?php endforeach;?>
                </select>
                <div class="start-date">
                    <font>start</font>
                    <input name="start"
                           class="Wdate"
                           type="text"
                           onClick="WdatePicker({el:this,dateFmt:'yyyy-MM-dd'})"
                           value="<?= empty($_GET['start']) ? '': $_GET['start']?>"
                    >
                </div>
                <div class="end-date">
                    <font>end</font>
                    <input name="end"
                           class="Wdate"
                           type="text"
                           onClick="WdatePicker({el:this,dateFmt:'yyyy-MM-dd'})"
                           value="<?= empty($_GET['end']) ? '': $_GET['end']?>"
                    >
                </div>
                <button type="submit">Apply</button>
            </form>
        </div>
    </div>
    <div class="table-container">
        <table border="1" rowspan="0" colspan="0">
            <tr>
                <?php foreach ($order_Info->getField() as $item): ?>
                <td class="tdcenter"><?= $item; ?></td>
                <?php endforeach;?>
            </tr>
            <?php if ($info = $order_Info->getOrderInfo()): ?>
                    <?php foreach ($info as $items): ?>
                    <tr>
                        <?php
                        foreach ($items as $k => $item) {
                            $html = '<td class="tdcenter">';
                            switch ($k){
                                case 'giftImage':
                                case 'image':
                                    $html .= $item ? '<img style="width: 80px;" src="' . $item . '">':'';
                                    break;
                                case 'options':
                                    if(!empty($item)){
                                        $options = json_decode($item,true);
                                        foreach($options as $option){
                                            $html .="<ol>".array_keys($option)[0].":".array_values($option)[0]."</ol>";
                                        }
                                    }
                                    break;
                                default:
                                    $html .= $item;
                                    break;
                            }
                            $html .= '</td>';
                            echo $html;

                        } ?>
                    </tr>
                    <?php endforeach; ?>
            <?php endif; ?>
        </table>
        <?php is_integer()?>
        <div calss="paging">
            <?php $page = (!empty($_GET['page']) && $_GET['page'] >= 1) ? $_GET['page'] : 1;?>
            <?php if($_GET['page'] > 1):?>
            <a href="?page=<?= $page-1?>&start=<?= $_GET['start']?>&end=<?= $_GET['end']?>&pageSize=<?= $_GET['pageSize']?>&search=<?= $_GET['search']?>"><strong>上一页</strong></a>
            <?php else:?>
                <span>上一页</span>
            <?php endif;?>
            共<?php $pageSize = $order_Info->getQueryWhereFieldStr('pageSize') ?? 20;
            echo $allpage = ceil($order_Info->getOrderInfo('getNumber')/$pageSize); ?>页
            <?php if($_GET['page'] < $allpage):?>
                <a href="?page=<?= $page+1?>&start=<?= $_GET['start']?>&end=<?= $_GET['end']?>&pageSize=<?= $_GET['pageSize']?>&search=<?= $_GET['search']?>"><strong>下一页</strong></a>
            <?php else:?>
                <span>下一页</span>
            <?php endif;?>
        </div>
    </div>
</div>
<script src="static/js/index.js"></script>
</body>
</html>