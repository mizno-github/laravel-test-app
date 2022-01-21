<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>apiCharenge!</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/api.js') }}"></script>
</head>
<body>
    <h1>apiの練習</h1>
    <h2>todo_list</h2>
    <ul id="list"></ul>
    <input type="hidden" name="id" id="inputId">
    <label>
        <br>タイトル
        <input type="text" name="inputTitle" id="inputTitle">
    </label>
    <label>
        <br>コンテント
        <input type="text" name="inputContent" id="inputContent">
    </label>
    <input id="updateOrCreate" type="button" value="作成or編集">
</body>

</html>
