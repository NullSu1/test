<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="vue.js"></script>
</head>
<body>
<div class="app">{{message}}
</div>
<div id="app-2">
  <span v-bind:title="message">
    鼠标悬停几秒钟查看此处动态绑定的提示信息！
  </span>
</div>

<div id="app-3">
    <p v-if="seen">now,you can see that</p>
    <p v-if="!seen">now,you can not see</p>
</div>

<div id="app-4">
    <ol>
        <li v-for="todo in todos">
            {{ todo.text }}
        </li>
    </ol>
</div>

<script>
    const app = new Vue({
        el: '.app',
        data: {
            message: 'Hello Vue!'
        }
    });
    const app2 = new Vue({
        el: '#app-2',
        data: {
            message: '页面加载于 ' + new Date().toLocaleString()
        }
    });
    const app3 = new Vue({
        el: '#app-3',
        data: {
            seen: true
        }
    });
    var app4 = new Vue({
        el: '#app-4',
        data: {
            todos: [
                { text: '学习 JavaScript' },
                { text: '学习 Vue' },
                { text: '整个牛项目' }
            ]
        }
    })
    console.log('1');
</script>
</body>
</html>


