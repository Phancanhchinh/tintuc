<div class="col-lg-8 blog__content mb-72">

        <!-- Worldwide News -->
        <section class="section">
            <div class="title-wrap title-wrap--line">
                <h3 class="section-title">{{trans('home.General')}}</h3>
            </div>
            @foreach ($NewsGaneral as $item)
                <article class="entry card post-list">
                        <div class="entry__img-holder post-list__img-holder card__img-holder" style="background-image: url('mid/upload/images/{{$item->urlHinh}}')">
                        <a href="{{route('detail',['tenkd' =>$item->TieuDe_KhongDau ,'lang' => Session::get('locale')])}}" class="thumb-url"></a>
                        <img src="img/content/list/list_post_1.jpg" alt="" class="entry__img d-none">
                        <span class="entry__meta-category entry__meta-category--label entry__meta-category--align-in-corner entry__meta-category--blue">{{$item->loaitin->Ten}}</span>
                        </div>

                        <div class="entry__body post-list__body card__body">
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
                            <p>{!!$item->TomTat!!}</p>
                        </div>
                        </div>
                </article>
            @endforeach
        </section> <!-- end worldwide news -->

        <!-- Pagination -->
        <div class="row">
            {{$NewsGaneral->links()}}
        </div>

    </div> <!-- end posts -->
