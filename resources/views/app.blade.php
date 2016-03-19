<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>サンプル蔵</title>
    <link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <style type="text/css">
    body {
            padding-top: 60px;
            padding-bottom: 50px;
        }
    }
    </style>

@if ( $viewinfo->workID == '1')
    <!-- 一件表示のコードエリア    -->
    <link href="{{asset('/assets/css/prism.css')}}" rel="stylesheet">
    <style type="text/css">
        div.codebox {
            height: 30em;
            overflow: auto;
            /* スクロールバーを自動表示(※) */
        }
    </style>
@endif

</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">サンプル蔵</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                @if ( $viewinfo->workID == '0')
                    <!-- 一覧表示ならactive/ not enabled-->
                    <li class="active" enabled="false"><a>一覧 <span class="sr-only">(current)</span></a></li>
                @else
                    <!-- でなければ、not active/ enabled -->
                    <li><a href="/codelive">一覧 <span class="sr-only">(current)</span></a></li>
                @endif 
                @if (Auth::user()->name == '管理者' )
                    @if ( $viewinfo->workID == '2')                    
                    <li class="active" enabled="false"><a>新規 <span class="sr-only">(current)</span></a></li>
                    @else
                    <li><a href="/codelive/create">新規</a></li>
                    @endif
               @endif
                    <!-- ダミー　-->
                    <li><a href="">About</a></li>
                    <li><a href="">Contact</a></li>
                @if ( $viewinfo->workID == '0')
                    <li class="dropdown">
                @else
                    <li class="dropdown disabled">
                @endif
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-duplicate"></span>　{{ $viewinfo->currLang }} <span class="caret"></span></a> 
                    @if ( $viewinfo->workID
                        == '0')
                        <ul class="dropdown-menu" role="menu">
                        @foreach($viewinfo->lang_table as $itm)
                            <li><a href="/codelive/chenglang/{{ $itm->lid }}"><span class="glyphicon glyphicon-option-vertical"></span>　{{$itm->lname }}</a></li>
                        @endforeach 
                    @endif
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->email }} <span class="caret"></span>
                            </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
                </ul>

            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @yield('content')
            </div>
        </div>
        <nav class="navbar navbar-default navbar-fixed-bottom">
            <p class="navbar-text navbar-right">©Copyright Office YUAi 2016-　　　</p>
        </nav>
    </div>
</body>
</htm/>
<!-- prism JS 一件表示でのみ使うので-->
@if ( $viewinfo->workID == '1')
<script src="{{asset('/assets/js/prism.js')}}"></script>
@endif
<!-- jQuery JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>