<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>サンプル蔵</title>
    <link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="jumbotron">
            <h1><span/>CodeLive Administrator</h1>
            <p><span/><span class="glyphicon glyphicon-warning-sign"></span> データを削除するとその配下にあるデータが削除されます</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</htm/>
<!-- jQuery JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>