<?php if(Session::has('locale')){
    $lang = Session::get('locale');
}else{
    $lang ="vi";
}
?>
<aside class="col-lg-4 sidebar sidebar--1 sidebar--right">
    <!-- Widget Ad 300 -->
    <aside class="widget widget_media_image">
    <a href="#">
        <img src="img/content/placeholder_336.jpg" alt="">
    </a>
    </aside> <!-- end widget ad 300 -->

    <!-- Widget Categories -->
    <aside class="widget widget_categories">
    <h4 class="widget-title">{{trans('home.type')}}</h4>
    <ul>
        @foreach ($NewsFastByType as $item)
            <li><a href="{{route('detailloaitin',['tenkd' => $item->Ten_KhongDau,'lang' => $lang])}}">{{$item->Ten}} <span class="categories-count">{{count($item->tin)}}</span></a></li>
        @endforeach

    </ul>
</aside> <!-- end widget categories -->
