
<!-- Sidebar -->
<aside class="col-lg-4 sidebar sidebar--right">
    <!-- Widget Popular Posts -->
    <aside class="widget widget-popular-posts">
    <h4 class="widget-title">{{trans('home.trending')}}</h4>
    <ul class="post-list-small">
        @foreach ($newsRateView as $txn)
            <li class="post-list-small__item">
                <article class="post-list-small__entry clearfix">
                    <div class="post-list-small__img-holder">
                    <div class="thumb-container thumb-100">
                        <a href="{{route('detail',['tenkd' =>$txn->TieuDe_KhongDau ,'lang' => Session::get('locale')])}}">
                            <img src="mid/upload/images/{{$txn->urlHinh}}"  alt="{{$txn->TieuDe}}" class="post-list-small__img--rounded lazyload">
                        </a>
                    </div>
                    </div>
                    <div class="post-list-small__body">
                    <h3 class="post-list-small__entry-title">
                        <a href="{{route('detail',['tenkd' =>$txn->TieuDe_KhongDau ,'lang' => Session::get('locale')])}}">{{$txn->TieuDe}}</a>
                    </h3>
                    <ul class="entry__meta">
                        <li class="entry__meta-date">
                                {{date('d/m/Y',strtotime($txn->Ngay))}}
                        </li>
                    </ul>
                    </div>
                </article>
            </li>
        @endforeach
    </ul>
</aside> <!-- end widget popular posts -->
