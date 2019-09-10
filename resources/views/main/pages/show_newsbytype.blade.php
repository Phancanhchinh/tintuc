<!-- Posts -->
<div class="col-lg-8 blog__content">

    <!-- Latest News -->
    <section class="section tab-post mb-16">
    <div class="title-wrap title-wrap--line">
        <h3 class="section-title">{{trans('home.news')}}</h3>
        <div class="tabs tab-post__tabs">
        <ul class="tabs__list">
            <li class="tabs__item tabs__item--active">
                <a href="#tab-all" class="tabs__trigger">{{trans('home.all')}}</a>
            </li>
            @foreach ($NewsByType as $item)
                <li class="tabs__item">
                    <a href="#tab-{{$item->Ten_KhongDau}}" class="tabs__trigger">{{$item->Ten}}</a>
                </li>
            @endforeach
        </ul> <!-- end tabs -->
        </div>
    </div>

    <!-- tab content -->
<div class="tabs__content tabs__content-trigger tab-post__tabs-content">
<div class="tabs__content-pane tabs__content-pane--active" id="tab-all">
<div class="row card-row">
    @foreach ($NewsFastAll as $item)
        @foreach ($typenews as $lt)
            @if ($lt->id == $item->idLT)
                <div class="col-md-6">
                    <article class="entry card">
                        <div class="entry__img-holder card__img-holder">
                        <a href="{{route('detail',['tenkd' =>$item->TieuDe_KhongDau])}}">
                            <div class="thumb-container thumb-70">
                                <img  src="mid/upload/images/{{$item->urlHinh}}" class="entry__img lazyload" alt="{{$item->TieuDe}}" />
                            </div>
                        </a>
                        <span class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--violet">{{$lt->Ten}}</span>
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
            @endif
        @endforeach
    @endforeach
</div>
</div> <!-- end pane 1 -->
@foreach ($NewsByType as $item)
<div class="tabs__content-pane" id="tab-{{$item->Ten_KhongDau}}">
    <div class="row card-row">
    <?php
        $lang = "vi";
        if(Session::has('locale'))
        {
            $lang = Session::get('locale');
        }
        $id = $item->id;
        $query = DB::Select('select * from tin where idLT='.$id.' and AnHien=1 and lang="'.$lang.'" ORDER BY id DESC Limit 0,4');
    ?>
    @foreach ($query as $qr)
        <div class="col-md-6">
            <article class="entry card">
                <div class="entry__img-holder card__img-holder">
                <a href="{{route('detail',['tenkd' =>$qr->TieuDe_KhongDau ,'lang' => Session::get('locale')])}}">
                    <div class="thumb-container thumb-70">
                    <img  src="mid/upload/images/{{$qr->urlHinh}}" class="entry__img lazyload" alt="{{$qr->TieuDe}}" />
                    </div>
                </a>
                <span class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--green">{{$item->Ten}}</span>
                </div>
                <div class="entry__body card__body">
                <div class="entry__header">
                    <h2 class="entry__title">
                    <a href="{{route('detail',['tenkd' =>$qr->TieuDe_KhongDau ,'lang' => Session::get('locale')])}}">{{$qr->TieuDe}}</a>
                    </h2>
                    <ul class="entry__meta">
                    <li class="entry__meta-date">
                        {{date('d/m/Y',strtotime($qr->Ngay))}}
                    </li>
                    </ul>
                </div>
                <div class="entry__excerpt">
                    <p>{{$qr->TomTat}}</p>
                </div>
                </div>
            </article>
        </div>
    @endforeach
</div>
</div> <!-- end pane 5 -->
@endforeach


</div> <!-- end tab content -->
</section> <!-- end latest news -->
</div> <!-- end posts -->
