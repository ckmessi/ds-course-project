<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
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
            
            <ul class="nav nav-tabs" role="tablist" id="myTab">
              <li role="presentation" class="active"><a href="#project1" role="tab" data-toggle="tab">实验1</a></li>
              <li role="presentation"><a href="#project2" role="tab" data-toggle="tab">实验2</a></li>
            </ul>

            <div class="tab-content" style="margin-top: 20px;">
              <div role="tabpanel" class="tab-pane fade in active" id="project1">
                  <div class="row" id="project1">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">实验1评分情况</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover">
                                    @foreach ($project1_list as $student)
                                        @if ($student['grade_point'] < 60)
                                            <tr class="danger">
                                        @elseif ($student['grade_point'] < 90)
                                            <tr class="warning">
                                        @else
                                            <tr class="success">
                                        @endif
                                          <td>#</td>
                                          <td>{{ $student['student_id'] }}</td>
                                          <td>{{ $student['user_name'] }}</td>
                                          <td>{{ $student['grade_point'] }}</td>
                                          <td>{{ $student['grade_comment'] }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane fade" id="project2">
                  <div class="row" id="project2">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">实验2评分情况</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover">
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>

            <script>
              $(function () {
                $('#myTab a:last').tab('show')
              })
            </script>
                
        </div>
    </body>
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.3/vue.min.js"></script>

    <script type="text/javascript">
        $('#myTab a').click(function (e) {
          e.preventDefault()
          $(this).tab('show')
        })
    </script>
</html>
