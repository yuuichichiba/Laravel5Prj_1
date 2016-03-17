@extends('app') @section('content')
<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <p class="navbar-text">一覧 ( {{ $codelives->total() }} )</a>
        </div>
        <!-- サーチ -->
        <form class="navbar-form navbar-left" method="get" action="/codelive" role="search">
            <div class="form-group">
            @if ($viewinfo->keyword == null)
            <input type="text" class="form-control" name = "keyword" placeholder="Search">
            @else 
            <input type="text" class="form-control" name = "keyword" value="{{$viewinfo->keyword}}">
            @endif
            </div>
            @if ($viewinfo->keyword == null)
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
            @else 
            <a  class="btn btn-default" href = "/codelive"><span class="glyphicon glyphicon-refresh"></a>
            @endif
        </form> 
        <!-- 言語選択 -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-th-list"></span>　{{ $viewinfo->currBunrui }} <span class="caret"></span></a> 
                    @if ($viewinfo->bunrui_table != null)
                    <ul class="dropdown-menu" role="menu">
                        @foreach($viewinfo->bunrui_table as $itm)
                        <li><a href="/codelive/chengbunrui/{{ $itm->bid}}"><span class="glyphicon glyphicon-tag"></span>　{{$itm->bname }}</a></li>
                        @endforeach
                    </ul>
                    @endif
                </li>
            </ul>
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

            <th width=150>最終更新日時</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($codelives as $itm)
        <tr>
            <td>{{ $itm['title'] }}</td>
            <td> <?php mb_strlen($itm['body']) > 120 ? $subs = mb_substr($itm['body'], 0, 120).'...' : $subs = $itm['body'];
echo $subs ?></td>
            <td>{{ $itm['updated_at'] }}</td>
            <td>
                <a class="btn btn-primary " href="/codelive/{{ $itm['id'] }}">
                    <span class="glyphicon glyphicon-folder-open"></span>　詳細</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--  pagenate render  -->
{{ $codelives->render() }} @endsection