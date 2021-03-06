    @extends('main.layouts.index')
    @section('content')
    <div class="container">

    <!-- slider -->
    <div class="row carousel-holder">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                    <div class="mt-5"><h1>Đăng ký tài khoản</h1></div>
                    <div class="col-md-12 text-center text-danger">
                        @if (session('thongbao'))
                            <h1>{{session('thongbao')}}</h1>
                        @endif
                    </div>
                    <div class="panel-body">
                    <div>
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $err)
                                    {{$err}} <br/>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <form action="" method="POST">
                        @csrf
                        <div>
                            <label>Họ tên</label>
                            <input type="text" class="form-control" placeholder="Username" name="name" aria-describedby="basic-addon1">
                        </div>
                        <br>
                        <div>
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1"
                            >
                        </div>
                        <br>
                        <div>
                            <label>Phone</label>
                            <input type="text" class="form-control" placeholder="Phone" name="phone" aria-describedby="basic-addon1"
                            >
                        </div>
                        <br>
                        <div>
                            <label>Address</label>
                            <input type="text" class="form-control" placeholder="Address" name="address" aria-describedby="basic-addon1"
                            >
                        </div>
                        <br>
                        <div>
                            <label>Nhập mật khẩu</label>
                                <input type="password" class="form-control" name="password" aria-describedby="basic-addon1">
                        </div>
                        <br>
                        <div>
                            <label>Nhập lại mật khẩu</label>
                                <input type="password" class="form-control" name="passwordAgain" aria-describedby="basic-addon1">
                        </div>
                        <br>
                        <button type="submit" class="btn mb-5">Đăng ký
                        </button>
                    </form>
                    </div>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
    <!-- end slide -->
    </div>
    @endsection
