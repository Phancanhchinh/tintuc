    @extends('main.layouts.index')
    @section('content')
    <div class="main-container container" id="main-container">
            <!-- Content -->
            <div class="row">

                <!-- post content -->
                <div class="col-lg-8 blog__content mb-72">
                <div class="content-box">

                    <!-- standard post -->
                    <article class="entry mb-0">

                    <div class="single-post__entry-header entry__header">
                        <a href="categories.html" class="entry__meta-category entry__meta-category--label entry__meta-category--green">{{$detailNews->loaitin->Ten}}</a>
                        <h1 class="single-post__entry-title">
                        {{$detailNews->TieuDe}}
                        </h1>

                        <div class="entry__meta-holder">
                        <ul class="entry__meta">
                            <li class="entry__meta-date">
                                {{date('d/m/Y',strtotime($detailNews->Ngay))}}
                            </li>
                        </ul>

                        <ul class="entry__meta">
                            <li class="entry__meta-views">
                            <i class="ui-eye"></i>
                            <span>{{$detailNews->SoLanXem}}</span>
                            </li>
                            <li class="entry__meta-comments">
                            <a href="#">
                                <i class="ui-chat-empty"></i>{{$comment->count()}}
                            </a>
                            </li>
                        </ul>
                        </div>
                    </div> <!-- end entry header -->

                    <div class="entry__img-holder">
                        <img src="mid/upload/images/{{$detailNews->urlHinh}}" alt="{{$detailNews->TieuDe}}" class="entry__img">
                    </div>

                    <div class="entry__article-wrap">
                        <div class="entry__article">
                                {!!$detailNews->Content!!}
                        <!-- tags -->
                        <div class="entry__tags">
                            <i class="ui-tags"></i>
                            <span class="entry__tags-label">Tags:</span>
                            <a href="#" rel="tag">{{$detailNews->tags}}</a>
                        </div> <!-- end tags -->

                        </div> <!-- end entry article -->
                    </div> <!-- end entry article wrap -->


                    <!-- Related Posts -->
                    <section class="section related-posts mt-40 mb-0">
                        <div class="title-wrap title-wrap--line title-wrap--pr">
                        <h3 class="section-title">{{trans('home.related')}}</h3>
                        </div>

                        <!-- Slider -->
                        <div id="owl-posts-3-items" class="owl-carousel owl-theme owl-carousel--arrows-outside">

                        @foreach ($relateNews as $tlq)
                            <article class="entry thumb thumb--size-1">
                                    <div class="entry__img-holder thumb__img-holder" style="background-image: url('mid/upload/images/{{$tlq->urlHinh}}');">
                                    <div class="bottom-gradient"></div>
                                    <div class="thumb-text-holder">
                                        <h2 class="thumb-entry-title">
                                        <a href="{{route('detail',['id' =>$tlq->id])}}">{{$tlq->TieuDe}}</a>
                                        </h2>
                                    </div>
                                    <a href="{{route('detail',['id' =>$tlq->id])}}" class="thumb-url"></a>
                                    </div>
                            </article>
                        @endforeach

                        </div> <!-- end slider -->

                    </section> <!-- end related posts -->

                    </article> <!-- end standard post -->

                    <!-- Comments -->
                    <div class="entry-comments">
                        <div class="title-wrap title-wrap--line">
                            <h3 class="section-title">{{$comment->count()}} {{trans('home.comment')}}</h3>
                        </div>
                        <ul class="comment-list">
                            @foreach ($comment as $bl)
                                <li class="comment">
                                    <div class="comment-body">
                                        <div class="comment-avatar">
                                        <img alt="" src="img/content/single/comment_1.jpg">
                                        </div>
                                        <div class="comment-text">
                                        <h6 class="comment-author">{{$bl->HoTen}}</h6>
                                        <div class="comment-metadata">
                                            <a href="#" class="comment-date">{{date('d/m/Y',strtotime($bl->Ngay))}}</a>
                                        </div>
                                        <p>{{$bl->NoiDung}}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div> <!-- end comments -->

                    <!-- Comment Form -->
                    <div id="respond" class="comment-respond">
                    <div class="title-wrap">
                        <h5 class="comment-respond__title section-title">{{trans('home.comment')}}</h5>
                    </div>
                    <form id="form" class="comment-form" method="post" action="">
                        @csrf
                        <input type="hidden" name="idTin" value="{{$detailNews->id}}"/>
                        <p class="comment-form-comment">
                        <label for="NoiDung">{{trans('home.comment')}}</label>
                            <textarea id="NoiDung" name="NoiDung" rows="5" required="required"></textarea>
                        </p>
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $err)
                                    {{$err}} <br/>
                                @endforeach
                            </div>
                        @endif
                        <div class="row row-20">
                            <div class="col-lg-4">
                                <label for="name">{{trans('home.contact_name')}}: *</label>
                                @if (Auth::check())
                                    <input name="HoTen" id="HoTen" value="{{Auth::user()->name}}" type="text">
                                @else
                                    <input name="HoTen" id="HoTen" placeholder="nhập tên của bạn" type="text">
                                @endif
                            </div>
                            <div class="col-lg-4">
                                <label for="comment">Email: *</label>
                                @if (Auth::check())
                                    <input name="Email" id="Email" value="{{Auth::user()->email}}" type="email">
                                @else
                                    <input name="Email" id="Email" placeholder="nhập email của bạn" type="email">
                                @endif
                            </div>
                        </div>

                        <p class="comment-form-submit">
                            <button type="submit" class="btn btn-lg btn-color btn-button">{{trans('home.contact_button')}}</button>
                        </p>

                    </form>
                    </div> <!-- end comment form -->

                </div> <!-- end content box -->
                </div> <!-- end post content -->

                <!-- Sidebar -->
                <aside class="col-lg-4 sidebar sidebar--right">

                <!-- Widget Popular Posts -->
                <aside class="widget widget-popular-posts">
                    <h4 class="widget-title">Tin Xem Nhiều</h4>
                    <ul class="post-list-small">
                        @foreach ($newsRateView as $item)
                        <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <div class="thumb-container thumb-100">
                                    <a href="{{route('detail',['id' =>$item->id])}}">
                                        <img  src="mid/upload/images/{{$item->urlHinh}}" alt="{{$item->TieuDe}}" class="post-list-small__img--rounded lazyload">
                                    </a>
                                    </div>
                                </div>
                                <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                    <a href="{{route('detail',['id' =>$item->id ,'lang' => Session::get('locale')])}}">{{$item->TieuDe}}</a>
                                    </h3>
                                    <ul class="entry__meta">
                                    <li class="entry__meta-date">
                                            {{date('d/m/Y',strtotime($item->Ngay))}}
                                    </li>
                                    </ul>
                                </div>
                                </article>
                        </li>
                        @endforeach
                    </ul>
                </aside> <!-- end widget popular posts -->

                <!-- Widget Newsletter -->


                </aside> <!-- end sidebar -->

            </div> <!-- end content -->
            </div> <!-- end main container -->
    @endsection
