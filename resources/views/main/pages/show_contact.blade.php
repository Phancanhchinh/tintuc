@extends('main.layouts.index')
@section('content')
    <div class="main-container container" id="main-container">
        <!-- post content -->
        <div class="blog__content mb-72">
            <h1 class="page-title">{{trans('home.contact_header')}}</h1>

            <!-- Google Map -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13180.681806871988!2d106.65008744394854!3d10.838826463493787!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529770380b7a7%3A0xb9b2abb2c6f196c1!2zQ2jhu6MgUGjhuqFtIFbEg24gQuG6oWNo!5e0!3m2!1svi!2s!4v1558685816312!5m2!1svi!2s" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

            <div class="row justify-content-center">
            <div class="col-lg-8">
                <h4>{{trans('home.contact_body')}}</h4>
                <p>{{trans('home.contact_text')}}</p>
                <ul class="contact-items">
                <li class="contact-item">{{trans('home.contact_address')}} : 544 Phạm Văn Bạch Phường 12 Gò Vấp</li>
                <li class="contact-item">{{trans('home.contact_phone')}} : 078 390 9819</li>
                <li class="contact-item"><a href="mailto:phancanhchinh@gmail.com">phancanhchinh@gmail.com</a></li>
                </ul>

                <!-- Contact Form -->
                @if(session()->has('thongbao'))
                    {!! session('thongbao') !!}
                @else
                    <form id="contact-form" class="contact-form mt-30 mb-30" method="POST" action="">
                            @csrf
                        <div class="contact-name">
                            <label for="name">{{trans('home.contact_name')}}<abbr title="required" class="required">*</abbr></label>
                            <input name="name" id="name" type="text">
                        </div>
                        <div class="contact-email">
                            <label for="email">Email <abbr title="required" class="required">*</abbr></label>
                            <input name="email" id="email" type="email">
                        </div>
                        <div class="contact-message">
                            <label for="message">{{trans('home.contact_message')}} <abbr title="required" class="required">*</abbr></label>
                            <textarea id="message" name="message" rows="7" required="required"></textarea>
                        </div>

                        <button type="submit" class="btn btn-lg btn-color btn-button">
                                {{trans('home.contact_button')}}
                        </button>
                    </form>
                @endif
            </div>
            </div>
        </div> <!-- end post content -->
        </div> <!-- end main container -->
@endsection
