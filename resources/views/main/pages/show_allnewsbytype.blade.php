@extends('main.layouts.index')
    @section('content')
    <div class="main-container container" id="main-container">
    <!-- Content -->
    <div class="row">
        <!-- Posts -->
        <div class="col-lg-8 blog__content mb-72">
        <h3 class="page-title">{{$detailType->Ten}}</h3>
        <div class="row card-row">
            @foreach ($allnewsByType as $item)
                <div class="col-md-6">
                        <article class="entry card">
                            <div class="entry__img-holder card__img-holder">
                            <a href="{{route('detail',['tenkd' =>$item->TieuDe_KhongDau])}}">
                                <div class="thumb-container thumb-70">
                                <img  src="mid/upload/images/{{$item->urlHinh}}" class="entry__img lazyload" alt="{{$item->TieuDe}}" />
                                </div>
                            </a>
                        <a href="#" class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--green">{{$item->loaitin->Ten}}</a>
                            </div>
                            <div class="entry__body card__body">
                            <div class="entry__header">
                                <h2 class="entry__title">
                                <a href="{{route('detail',['tenkd' =>$item->TieuDe_KhongDau ,'lang' => Session::get('locale')])}}">{{$item->TieuDe}}</a>
                                </h2>
                                <ul class="entry__meta">
                                <li class="entry__meta-date">
                                    {{date('d/m/Y',strtotime($item->Ngay))}}
                                </li>
                                </ul>
                            </div>
                            <div class="entry__excerpt">
                                <p>{{$item->TomTat}}</p>
                            </div>
                            </div>
                        </article>
                    </div>
            @endforeach
        </div>
        {{$allnewsByType->links()}}

        </div> <!-- end posts -->

        <!-- Sidebar -->
        <aside class="col-lg-4 sidebar sidebar--right">

        <!-- Widget Popular Posts -->
        <!-- Widget Popular Posts -->
        <aside class="widget widget-popular-posts">
                <h4 class="widget-title">{{trans('home.trending')}}</h4>
                <ul class="post-list-small">
                    @foreach ($newsRateView as $item)
                        <li class="post-list-small__item">
                                <article class="post-list-small__entry clearfix">
                                <div class="post-list-small__img-holder">
                                    <div class="thumb-container thumb-100">
                                    <a href="{{route('detail',['tenkd' =>$item->TieuDe_KhongDau])}}">
                                        <img src="mid/upload/images/{{$item->urlHinh}}" alt="{{$item->TieuDe}}" class=" lazyload">
                                    </a>
                                    </div>
                                </div>
                                <div class="post-list-small__body">
                                    <h3 class="post-list-small__entry-title">
                                    <a href="{{route('detail',['tenkd' =>$item->TieuDe_KhongDau])}}">{{$item->TieuDe}}</a>
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
        <aside class="widget widget_mc4wp_form_widget">
            <h4 class="widget-title">Newsletter</h4>
            <p class="newsletter__text">
            <i class="ui-email newsletter__icon"></i>
            Subscribe for our daily news
            </p>
            <form class="mc4wp-form" method="post">
            <div class="mc4wp-form-fields">
                <div class="form-group">
                <input type="email" name="EMAIL" placeholder="Your email" required="">
                </div>
                <div class="form-group">
                <input type="submit" class="btn btn-lg btn-color" value="Sign Up">
                </div>
            </div>
            </form>
        </aside> <!-- end widget newsletter -->

        <!-- Widget Socials -->
        <aside class="widget widget-socials">
            <h4 class="widget-title">Let's hang out on social</h4>
            <div class="socials socials--wide socials--large">
            <div class="row row-16">
                <div class="col">
                <a class="social social-facebook" href="#" title="facebook" target="_blank" aria-label="facebook">
                    <i class="ui-facebook"></i>
                    <span class="social__text">Facebook</span>
                </a><!--
                --><a class="social social-twitter" href="#" title="twitter" target="_blank" aria-label="twitter">
                    <i class="ui-twitter"></i>
                    <span class="social__text">Twitter</span>
                </a><!--
                --><a class="social social-youtube" href="#" title="youtube" target="_blank" aria-label="youtube">
                    <i class="ui-youtube"></i>
                    <span class="social__text">Youtube</span>
                </a>
                </div>
                <div class="col">
                <a class="social social-google-plus" href="#" title="google" target="_blank" aria-label="google">
                    <i class="ui-google"></i>
                    <span class="social__text">Google+</span>
                </a><!--
                --><a class="social social-instagram" href="#" title="instagram" target="_blank" aria-label="instagram">
                    <i class="ui-instagram"></i>
                    <span class="social__text">Instagram</span>
                </a><!--
                --><a class="social social-rss" href="#" title="rss" target="_blank" aria-label="rss">
                    <i class="ui-rss"></i>
                    <span class="social__text">Rss</span>
                </a>
                </div>
            </div>
            </div>
        </aside> <!-- end widget socials -->

        </aside> <!-- end sidebar -->

    </div> <!-- end content -->
    </div> <!-- end main container -->
    @endsection
