@extends('app') @section('content')
<h3 class="page-header">新規サンプル</h3>
<form class="form-horizontal" method="post" action="/codelive/store">
    <fieldset>
        <div class="form-group">
            <label class="col-lg-2 control-label" for="textArea">分類</label>
            <div class="col-lg-10">
                <input class="form-control"  readonly="true" value="{{$viewinfo->currBunrui}}"></input>
            </div>
        </div>
        <div class="form-group">
            <label for='title' class="col-lg-2 control-label" for="textArea">タイトル</label>
            <div class="col-lg-10">
                <textarea class="form-control" name="title" id="title" rows="1"></textarea>
                <a>{{$errors->first('title')}}</a>
            </div>
        </div>
        <div class="form-group">
            <label for 'body' class="col-lg-2 control-label">解説</label>
            <div class="col-lg-10">
                <textarea class="form-control" id="body" name="body" rows="10"></textarea>
                <a>{{$errors->first('body')}}</a>
            </div>
        </div>
        <div class="form-group">
            <label for 'src' class="col-lg-2 control-label">コード</label>
            <div class="col-lg-10">
                <textarea class="form-control" id="src" name="src" rows="15"></textarea>
                <a>{{$errors->first('src')}}</a>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <a class="btn btn-danger" href="/codelive"><span class="glyphicon glyphicon-remove-circle"></span>　キャンセル</a>
                <!-- aタグでpostしないようにする -->
                <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-share-alt"></span>　登録する</button>
                {{ csrf_field() }}
                <!--Laravelでpostするときに必要な csrf_tokenを送る -->
            </div>
        </div>
    </fieldset>
</form>
@endsection