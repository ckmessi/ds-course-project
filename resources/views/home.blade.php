<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DS Project</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 10vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 18px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>

        <div class="flex-center position-ref full-height">
                <div class="top-right links">
                @if (Session::has('user_id'))
                    <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    Logout</a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endif
                </div>
        </div>
       
        <div class="container">
            <div class="page-header">
              <h1>Hello, {{ $user_name or '未知用户'}}</h1>
            </div>
            
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    @if (Session::has('message_success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        {{ Session::get('message_success') }}
                    </div>
                    @endif

                    @if (Session::has('message_failed'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        {{ Session::get('message_failed') }}
                    </div>
                    @endif
                </div>
            </div>
                <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">实验1</div>
                        <div class="panel-body">
                            @if (isset($grade_project1))
                                <h3> {{ $grade_project1['grade_point'] }} </h3>
                                <p> {{ $grade_project1['grade_comment'] }} </p>
                                
                                @if ( $grade_project1['grade_confirm'] == true )
                                    <h4 style="float:right"> 您已确认 </h4>
                                @else
                                    <button type="button" class="btn btn-success" style="float:right" onclick="event.preventDefault();document.getElementById('comfirm-project1-form').submit();">确认无误</button>
                                    <form id="comfirm-project1-form" action="{{ url('/confirm') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                    </form>
                                @endif
                            @else
                                您的分数信息为空，请联系助教。
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</html>
