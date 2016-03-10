@extends('app') @section('content')
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">$itm
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">コード一覧 ( {{ $codelives->total() }} )</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ $viewinfo->currLang }} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        @foreach($viewinfo->bunrui_table as $itm)
                        <li><a href="/codelive/chenglang/{{ $itm->lid }}">{{$itm->lname }}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    </div>
</nav>
@if (Session::has('flash_message'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ Session::get('flash_message') }}
</div>
@endif

<table class="table table-striped table-hover ">
    <thead>
        <tr>
            <th width=200>タイトル</th>
            <th>説明</th>

            <th>最終更新日時</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($codelives as $itm)
        <tr>
            <td>{{ $codelives['title'] }}</td>
            <td> <?php mb_strlen($codelives['body']) > 120 ? $subs = mb_substr($codelives['body'], 0, 120).'...' : $subs = $codelives['body'];
echo $subs ?></td>
            <td>{{ $codelives['updated_at'] }}</td>
            <td>
                <a class="btn btn-primary " href="/srcarc/{{ $codelives['id'] }}">
                    <span class="glyphicon glyphicon-folder-open"></span>　詳細</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--  pagenate render  -->
{{ $codelives->render() }} @endsection