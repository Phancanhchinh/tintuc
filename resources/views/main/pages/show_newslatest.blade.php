<!-- Trending Now -->
<div class="container">
    <div class="trending-now">
    <span class="trending-now__label">
        <i class="ui-flash"></i>
        <span class="trending-now__text d-lg-inline-block d-none">{{trans('home.new')}}</span>
    </span>
    <div class="newsticker">
        <ul class="newsticker__list">
            @foreach ($newsLatest as $item)
                <li class="newsticker__item">
                    <a href="{{route('detail',['tenkd' =>$item->TieuDe_KhongDau ,'lang' => Session::get('locale')])}}" class="newsticker__item-url">
                        {{$item->TieuDe}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="newsticker-buttons">
        <button class="newsticker-button newsticker-button--prev" id="newsticker-button--prev" aria-label="next article"><i class="ui-arrow-left"></i></button>
        <button class="newsticker-button newsticker-button--next" id="newsticker-button--next" aria-label="previous article"><i class="ui-arrow-right"></i></button>
    </div>
    </div>
</div>
