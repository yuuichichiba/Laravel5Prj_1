@extends('admin') @section('content')

<div class="panel panel-info">
    <div class="panel-body">
        <table class="table table-striped table-hover ">
            <thead>
                <tr class="success">
                    <th>登録済み言語</th>
                    <th>prismマーキング</th>
                    <th>プレフィックス</th>
                    <th>備考</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($langs as $item)
                <tr>
                    <td>{{ $item['language']}}</td>
                    <td>{{ $item['langmark']}}</td>
                    <td>{{ $item['prefix']}}</td>
                    <td>{{ $item['note']}}</td>
                    <td>
                        <a class="btn btn-danger " href="/codelive/admin/dellang/{{ $item['id'] }}">
                            <span class="glyphicon glyphicon-trash"></span>　削　除</a>
                    </td>
                    <td>
                        <a class="btn btn-success " href="/codelive/admin/editbunrui/{{ $item['id'] }}">
                            <span class="glyphicon glyphicon-cog"></span>　分類編集</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="alert alert-infos" align="center">
            <a class="btn btn-info" data-toggle="modal" data-target="#conferm_apend"><span class="glyphicon glyphicon-plus"></span> 追　加</a>
        </div>
    </div>
</div>

<!-- 1.モーダルの配置 -->
<div class="modal fade" id="conferm_apend" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title" align="center">最後尾に言語を追加します</h3>
                </div>
                <div class="panel-body" align="center">

                    <form class="form-horizontal" method="post" action="/codelive/admin/apendlang">
                        <fieldset>
                            <div class="form-group">
                                <label for='title' class="col-lg-2 control-label" for="textArea">言語名</label>
                                <div class="col-lg-10">
                                    <input class="form-control" name="language" id="language" placeholder="必　須">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for='title' class="col-lg-2 control-label" for="textArea">prismマーキング</label>
                                <div class="col-lg-10">
                                    <input class="form-control" name="langmark" id="langmark" placeholder="必　須">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for='title' class="col-lg-2 control-label" for="textArea">プレフィックス</label>
                                <div class="col-lg-10">
                                    <input class="form-control" name="prefix" placeholder="オプション">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for='title' class="col-lg-2 control-label" for="textArea">備考</label>
                                <div class="col-lg-10">
                                    <input class="form-control" name="note" id="note" placeholder="オプション">
                                </div>
                            </div>
                            <p></p>
                            <div class="form-group" align="center">
                                <a class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>　キャンセル</a>
                                <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-flash"></span>　実　　　行</button>
                                {{ csrf_field() }}
                                <!--Laravelでpostするときに必要な csrf_tokenを送る -->
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection