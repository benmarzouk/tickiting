@extends('themes.default1.client.layout.client')
@section('breadcrumb')
<div class="site-hero">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="text">You are here: </li>
        <li>Home</li>
        <li class="active">Search Results</li>
    </ol>
</div>
@stop
@section('content')
<div id="content" class="site-content col-md-9">
    @forelse($result as $arti)
    <article class="format-standard type-post hentry clearfix">

        <header class="clearfix">
            <h3 class="post-title">
            <small><i class="fa fa-list-alt fa-2x fa-fw pull-left text-muted"></i></small>
                <a href="{{url('show/'.$arti->slug)}}">{{$arti->name}}</a>
            </h3>
            
        </header>
        <?php $str = $arti->description ?>
        <?php $excerpt = App\Http\Controllers\Client\kb\UserController::getExcerpt($str, $startPos = 0, $maxLength = 200) ?>
        <blockquote class="archive-description">
        <p>{!! strip_tags($excerpt) !!} </p>
        <a class="readmore-link" href="{{url('show/'.$arti->slug)}}">Read more</a>
        </blockquote>
        
        <div class="post-meta clearfix">
                <span class="date"><i class="fa fa-clock-o fa-fw"></i> {{$arti->created_at->format('l, d-m-Y')}}</span>
            </div><!-- end of post meta -->
        <hr>
        @empty 
        <p><h3><b>Sorry!</b></h3> No result has found.</p>
        @endforelse

    </article>
    <!-- end of page content -->
    <div class="pagination">
        <?php echo $result->render(); ?>
    </div>
</div>

@stop
</div>


@section('category')
<h2 class="section-title h4 clearfix">{!! Lang::get('lang.categories') !!}<small class="pull-right"><i class="fa fa-hdd-o fa-fw"></i></small></h2>
<ul class="nav nav-pills nav-stacked nav-categories">

    @foreach($categorys as $category)
<?php
$num = \App\Model\kb\Relationship::where('category_id','=', $category->id)->get();
$article_id = $num->pluck('article_id');
$numcount = count($article_id);
?>
    <li><a href="{{url('category-list/'.$category->slug)}}"><span class="badge pull-right">{{$numcount}}</span>{{$category->name}}</a></li>
    @endforeach
</ul>
@stop