<!-- Carousel posts -->
<section class="section mb-0">
        <div class="title-wrap title-wrap--line title-wrap--pr">
            <h3 class="section-title">{{$TypeCarousel->Ten}}</h3>
        </div>

        <!-- Slider -->
        <div id="owl-posts" class="owl-carousel owl-theme owl-carousel--arrows-outside">

            @foreach ($NewsCarousel as $item)
                <article class="entry thumb thumb--size-1">
                    <div class="entry__img-holder thumb__img-holder" style="background-image: url('mid/upload/images/{{$item->urlHinh}}');">
                        <div class="bottom-gradient"></div>
                        <div class="thumb-text-holder">
                        <h2 class="thumb-entry-title">
                            <a href="{{route('detail',['tenkd' =>$item->TieuDe_KhongDau,'lang' => Session::get('locale')])}}">{{$item->TieuDe}}</a>
                        </h2>
                        </div>
                        <a href="{{route('detail',['tenkd' =>$item->TieuDe_KhongDau])}}" class="thumb-url"></a>
                    </div>
                </article>
            @endforeach

        </div> <!-- end slider -->

        </section> <!-- end carousel posts -->
