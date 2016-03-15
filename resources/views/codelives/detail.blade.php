@extends('app') @section('content')
<div class="conainer">
    <!--  <h2 class="page-header">登録データ</h2> -->
    <form class="form-horizontal">
        <fieldset>
            <legend>データ詳細</legend>
            <div class="alert alert-infos" align="center">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <a class="btn btn-info" href="/codelive/edit/{{$codelive['id']}}"><span class="glyphicon glyphicon-pencil"></span> データ編集</a>
                <a class="btn btn-success" data-toggle="modal" data-target="#conferm_change"><span class="glyphicon glyphicon-random"></span> 分類変更</a>
                <a class="btn btn-danger" data-toggle="modal" data-target="#conferm_delete"><span class="glyphicon glyphicon-trash"></span> データ削除</a>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="textArea">分類</label>
                <div class="col-lg-10">
                    <input class="form-control" rows="1" readonly="true" value="{{$viewinfo->currBunrui}}"></input>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="textArea">タイトル</label>
                <div class="col-lg-10">
                    <input class="form-control" rows="1" readonly="true" value="{{$codelive['title']}}"></input>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">解説</label>
                <div class="col-lg-10">
                    <textarea class="form-control" id="body" name="body" rows="8" readonly="true">{{ $codelive['body'] }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">ソースコード</label>
                <div class="col-lg-10">
                    <div class="codebox"><pre class="line-numbers"><code class="language-{{ $viewinfo->currMark }}">{{ $codelive['src'] }}</code></pre>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>
<div>
    <!-- 1.モーダルの配置 -->
    <div class="modal fade" id="conferm_change" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center">分類を変更すると現在の一覧からは見ることができなくなります</h3>
                    </div>
                    <div class="panel-body" align="center">
                        <form class="form-horizontal" method="post" action="/codelive/changbid/{{$codelive['id']}}">
                            <fieldset>
                                <div class="form-group">
                                    <ul class="breadcrumb">
                                        <li class="active">現在の分類　:　{{ $viewinfo->currBunrui}}</li>
                                    </ul>
                                    <label for="select" class="col-lg-2 control-label">新分類</label>
                                    <div class="col-lg-10">
                                        <select class="form-control" name="select">
                                            @if ($viewinfo->bunrui_table != null) 
                                                @foreach($viewinfo->bunrui_table as $itm)
                                                <option value="{{$itm->bid }}">{{$itm->bname }}</option>
                             <!--                   <option>{{$itm->bname }}</option>  -->
                                                @endforeach 
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" align="center">
                                    <a class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>キャンセル</a>
                                    <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-flash"></span>実行</button>
                                    {{ csrf_field() }}
                                    <!--Laravelでpostするときに必要な csrf_tokenを送る -->
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>

                <div>
                    <a>　</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <!-- 2.モーダルの配置 -->
    <div class="modal fade" id="conferm_delete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog">
            <!-- 3.モーダルのコンテンツ -->
            <div class="modal-content">

                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center">一度消去すると元には戻せません</h3>
                    </div>
                    <div class="panel-body" align="center">
                        実行しますか？
                    </div>
                </div>
                <form method="post" action="/codelive/delete/{{$codelive['id']}}">
                    <div align="center">
                        <a class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>キャンセル</a>
                        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-flash"></span>削除を実行</button>
                        {{ csrf_field() }}
                        <!--Laravelでpostするときに必要な csrf_tokenを送る -->
                    </div>
                </form>
                <div>
                    <a>　</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection