@extends('app') @section('content')
<div class="conainer">
    <form class="form-horizontal" method="post" action="/codelive/update/{{ $codelive['id'] }}">
        <fieldset>
            <legend>投稿</legend>
            <div class="form-group">
                <label class="col-lg-2 control-label" for="textArea">タイトル</label>
                <div class="col-lg-10">
                    <textarea class="form-control" name="title" id="title" rows="1">{{ old('title', $codelive['title']) }}</textarea>
                    <a>{{$errors->first('title')}}</a>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">解説</label>
                <div class="col-lg-10">
                    <textarea class="form-control" id="body" name="body" rows="10">{{ old('body', $codelive['body']) }}</textarea>
                    <a>{{$errors->first('body')}}</a>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">ソースコード</label>
                <div class="col-lg-10">
                    <textarea class="form-control" id="body" name="src" rows="10">{{ old('src', $codelive['src']) }}</textarea>
                    <a>{{$errors->first('src')}}</a>
                </div>
            </div> 
            <div class="form-group">
                <label class="col-lg-2 control-label" for="input">行ハイライト</label>
                <div class="col-lg-10">
                    <input class="form-control" name="lines" id="lines" rows="1"　value="{{ old('lines', $codelive['lines']) }}">
                    <a>{{$errors->first('lines')}}</a>
                </div>
            </div>
                       
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <a class="btn btn-info " href="/codelive/{{ $codelive['id'] }}"><span class="glyphicon glyphicon-circle-arrow-left"></span>詳細に戻る</a>
                    <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-refresh"></span>元に戻す</button>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-open-file"></span>更新する</button>
                    {{ csrf_field() }}
                    <!--Laravelでpostするときに必要な csrf_tokenを送る -->
                </div>
            </div>
        </fieldset>
    </form>
</div>
@endsection