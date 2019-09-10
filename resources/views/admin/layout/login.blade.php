<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Trang Quản Lý</title>
    <link rel="stylesheet" href="{{asset('/admin/css/app.css')}}" />   {{-- them --}}
</head>
<body>
        <div class="container">
                <div class="row">
                    <div class="col-md-12 jumbotron jumbotron-fluid">
                            <h1 class="text-danger text-center">Please Login</h1>
                    </div>
                    <div class="col-md-12">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $err)
                                    {{$err}} <br/>
                                @endforeach
                            </div>
                        @endif
                        <form role="form" action="" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password">
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
    <script src="{{asset('/admin/js/app.js')}}"></script>     {{-- them --}}
</body>
</html>





