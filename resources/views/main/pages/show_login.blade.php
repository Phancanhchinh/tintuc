@extends('main.layouts.index')
@section('content')
<div class="container">
    <div class="row mt-5">
        <h2>Đăng Nhập</h2>
    </div>
    <div class="row mt-5 mb-5">
        <div class="col-md-4 text-center text-danger">
            @if (session('thongbao'))
                <h1>{{session('thongbao')}}</h1>
            @endif
        </div>
        <div class="col-md-4">
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
                    <button type="submit" class="btn btn-primary"  >Login</button>
            </form>
        </div>
    </div>
</div>
@endsection






