<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>获取文字位置信息</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&family=Italianno&family=Roboto:wght@500&display=swap"
          rel="stylesheet">
</head>
<style>
    .demo {
        display: flex;
    }

    .canvas-box {
        width: 690px;
        height: 690px;
        border: 1px solid black;
    }

    th, td {
        padding: 4px 6px;
    }
    input[type="range"]{
        width: 700px;
    }
</style>
<body>

<div class="demo">
    <div class="canvas-box">
        <canvas id="c" width="690" height="690"></canvas>
    </div>
    <div class="option">
        <div class="settings">
            <input type="file" name="file" id="file">
            <hr>
            <div class="opt">
                <label for="pdtId">产品SKU:</label>
                <input id="pdtId" type="text" value="">
            </div>
            <div class="opt">
                <label for="designIndex">定制方位:</label>
                <select name="designIndex" id="designIndex">
                    <option value="d1">d1</option>
                    <option value="d2">d2</option>
                    <option value="d3">d3</option>
                    <option value="d4">d4</option>
                    <option value="d5">d5</option>
                    <option value="d6">d6</option>
                    <option value="d7">d7</option>
                    <option value="d8">d8</option>
                </select>
            </div>
            <div class="opt">
                <label for="fontFamily">字体:</label>
                <select name="fontFamily" id="fontFamily">
                    <option value="Roboto">Roboto</option>
                    <option value="Dancing Script">Dancing</option>
                    <option value="Italianno">Italianno</option>
                </select>
            </div>
            <div class="opt">
                <label for="color">color:</label>
                <input id="color" type="text" value="#484848"/>
            </div>
            <hr>
            <div class="fields"></div>
            <button id="save">提交</button>
        </div>
    </div>

</div>

<script src="static/fabric.min.js"></script>
<script src="static/fabric.textCurved.js"></script>
<script src="static/Jewelry.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
<script src="static/index.js"></script>
</body>
</html>