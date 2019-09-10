<!-- Posts from categories -->
<section class="section mb-0">
    <div class="row">
        <!-- Technology -->
        @foreach ($NewsColumn as $item)
        <div class="col-md-6">
            <div class="title-wrap title-wrap--line">
                <h3 class="section-title">{{$item->Ten}}</h3>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <?php
                        $query = DB::table('tin')->where('AnHien','=',1)->where('idLT','=',$item->id)->orderby('id','desc')->first();
                    ?>
                    <article class="entry thumb thumb--size-2">
                        <div class="entry__img-holder thumb__img-holder" style="background-image: url('mid/upload/images/{{$query->urlHinh}}');">
                        <div class="bottom-gradient"></div>

                        <div class="thumb-text-holder thumb-text-holder--1">
                            <h2 class="thumb-entry-title">
                            <a href="{{route('detail',['tenkd' =>$query->TieuDe_KhongDau,'lang' => Session::get('locale')])}}">{{$query->TieuDe}}</a>
                            </h2>
                            <ul class="entry__meta">
                            <li class="entry__meta-date">
                                {{date('d/m/Y',strtotime($query->Ngay))}}
                            </li>
                            </ul>
                        </div>
                        <a href="{{route('detail',['tenkd' =>$query->TieuDe_KhongDau ,'lang' => Session::get('locale')])}}" class="thumb-url"></a>
                        </div>
                    </article>
                </div>
                <div class="col-lg-6">
                <ul class="post-list-small post-list-small--dividers post-list-small--arrows mb-24">
                    <?php
                        $list = DB::table('tin')->where('AnHien','=',1)->where('idLT','=',$item->id)->where('id','<>',$query->id)->orderby('id','desc')->limit(4)->get();
                    ?>
                    @foreach ($list as $item)
                        <li class="post-list-small__item">
                            <article class="post-list-small__entry">
                                <div class="post-list-small__body">
                                <h3 class="post-list-small__entry-title">
                                    <a href="{{route('detail',['tenkd' =>$item->TieuDe_KhongDau ,'lang' => Session::get('locale')])}}">{{$item->TieuDe}}</a>
                                </h3>
                                </div>
                            </article>
                        </li>
                    @endforeach


                </ul>
                </div>
            </div>
            </div> <!-- end technology -->
        @endforeach
    </div>
    </section> <!-- end posts from categories -->
