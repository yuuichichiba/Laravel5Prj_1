@extends('admin') @section('content')

<div class="panel panel-info">
    <div class="panel-body">
        <table class="table table-striped table-hover ">
            <thead>
                <tr>
                    <th>{{ $lang['language'] }} -- 分類名</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bunruis as $item)
                <tr>
                    <td>{{ $item['b_name']}}</td>
                    <td>

                        <!--                 {#<a class="btn btn-success" href="/codelive/admin/eitb_name/{{ $item['id'] }}">#} -->
                        <a class="btn btn-info " data-toggle="modal" data-target="#modal_editbunrui" data-whatever="{{ $item['id'] }}">
                            <span class="glyphicon glyphicon-cog"></span>　編　集</a>
                    </td>
                    <td>
                        <form method="post" action="/codelive/admin/bumruidel/{{ $item['id'] }}">
                            <fieldset>
                                <input type="hidden" name="langid" value="{{ $lang['id'] }}">
                                <button type="submit " class="btn btn-danger "><span class="glyphicon glyphicon-trash"></span>　削　除</button>
                                {{ csrf_field() }}
                                <!--Laravelでpostするときに必要な csrf_tokenを送る -->
                            </fieldset>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="alert alert-infos" align="center">
        <a class="btn btn-default" href="/codelive/admin/ "><span class="glyphicon glyphicon-share "></span> メイン</a>
        <button class="btn btn-info " data-toggle="modal" data-target="#modal_bunrui"><span class="glyphicon glyphicon-plus "></span> 追　加</button>
    </div>
</div>


<div id="modal_bunrui" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel ">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title " align="center">最後尾に分類を追加します</h3>
                </div>
                <div class="panel-body " align="center">
                    <form class="form-horizontal " method="post" action="/codelive/admin/bunruiappend/{{ $lang['id'] }}">
                        <fieldset>
                            <div class="form-group ">
                                <label for='title' class="col-lg-2 control-label " for="textArea ">分類名</label>
                                <div class="col-lg-10 ">
                                    <input class="form-control " name="b_name" id="b_name">
                                </div>
                            </div>
                            <div class="form-group" align="center">
                                <a class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove "></span> キャンセル</a>
                                <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-flash "></span> 実　　行</button>
                                {{ csrf_field() }}

                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_editbunrui" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myLargeModalLabel">分類名称の変更</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal " method="post" action="/codelive/admin/bunruirename/{{ $lang['id'] }}">
                    <fieldset>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">新しい分類名:</label>
                            <input type="text" class="form-control" name="newname" id="recipient-name">
                        </div>
                    </fieldset>
                    <div class="modal-hidden">
                        <input type="hidden" name="bid" id="bid">
                    </div>

                    <div class="form-group" align="center">
                        <a class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove "></span> キャンセル</a>
                        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-flash "></span> 実　　行</button>
                        {{ csrf_field() }}

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection 
@section('script') 
    $('#modal_editbunrui').on('show.bs.modal', function (event) { 
        var button = $(event.relatedTarget) 
        var recipient = button.data('whatever') 
        
        var modal = $(this) 
        modal.find('.modal-hidden input').val(recipient) }) 
@endsection