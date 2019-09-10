<section class="featured-posts-grid">
    <div class="container">
    <div class="row row-8">

        <div class="col-lg-6">

        <!-- Small post -->
            @for ($i = 0; $i < 3; $i++)
                <?php $item = $newsHot[$i] ?>
                <div class="featured-posts-grid__item featured-posts-grid__item--sm">
                        <article class="entry card post-list featured-posts-grid__entry">
                            <div class="entry__img-holder post-list__img-holder card__img-holder" style="background-image: url(mid/upload/images/{{$item->urlHinh}})">
                                <a href="{{route('detail',['tenkd' =>$item->TieuDe_KhongDau ,'lang' => Session::get('locale')])}}" class="thumb-url"></a>
                                <img src="mid/upload/images/{{$item->urlHinh}}" alt="{{$item->TieuDe}}" class="entry__img d-none">
                                <span class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--violet">{{$item->loaitin->Ten}}</span>
                            </div>

                            <div class="entry__body post-list__body card__body">
                                <h2 class="entry__title">
                                <a href="{{route('detail',['tenkd' =>$item->TieuDe_KhongDau ,'lang' => Session::get('locale')])}}">{{$item->TieuDe}}</a>
                                </h2>
                                <ul class="entry__meta">
                                <li class="entry__meta-date">
                                    {{date('d/m/Y',strtotime($item->Ngay))}}
                                </li>
                                </ul>
                            </div>
                        </article>
                </div>
            @endfor
            <!-- end post -->
        </div> <!-- end col -->

        <div class="col-lg-6">
        <!-- Large post -->
            @if ($newsHot[3])
                <?php $item = $newsHot[3]; ?>
                <div class="featured-posts-grid__item featured-posts-grid__item--lg">
                    <article class="entry card featured-posts-grid__entry">
                        <div class="entry__img-holder card__img-holder">
                            <a href="{{route('detail',['tenkd' =>$item->TieuDe_KhongDau ,'lang' => Session::get('locale')])}}">
                                <img src="mid/upload/images/{{$item->urlHinh}}" alt="{{$item->TieuDe}}" class="entry__img">
                            </a>
                            <span class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--green">{{$item->loaitin->Ten}}</span>
                        </div>
                        <div class="entry__body card__body">
                            <h2 class="entry__title">
                            <a href="{{route('detail',['tenkd' =>$item->TieuDe_KhongDau ,'lang' => Session::get('locale')])}}">{{$item->TieuDe}}</a>
                            </h2>
                            <ul class="entry__meta">
                            <li class="entry__meta-date">
                                    {{date('d/m/Y',strtotime($item->Ngay))}}
                            </li>
                            </ul>
                        </div>
                    </article>
                </div> <!-- end large post -->
            @endif
        </div>
    </div>
    </div>
</section> <!-- end featured posts grid -->
