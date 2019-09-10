<aside class="widget widget-rating-posts">
        <h4 class="widget-title">{{trans('home.Recommend')}}</h4>

        @foreach ($recommend as $item)
            <article class="entry">
                    <div class="entry__img-holder">
                    <a href="{{route('detail',['tenkd' =>$item->TieuDe_KhongDau])}}">
                        <div class="thumb-container thumb-60">
                        <img  src="mid/upload/images/{{$item->urlHinh}}" class="entry__img lazyload" alt="{{$item->TieuDe}}">
                        </div>
                    </a>
                    </div>

                    <div class="entry__body">
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
                    </div>
            </article>
        @endforeach
        </aside> <!-- end widget recommended (rating) -->
</aside> <!-- end sidebar 1 -->
