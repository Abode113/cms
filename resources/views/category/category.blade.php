@extends('view.HomePage.home')

@section('title')
    list of category
@endsection
@if(array_key_exists("fatherObj",$Data))
@section('metaDescription')
{{$Data['fatherObj']->desc}}
@endsection
@endif

<link href="{{ asset('css/category.css') }}" rel="stylesheet" type="text/css" >


@section('Body')
<div class="container">
    @foreach($Data['allcategory'] as $index=>$category)
    <div class="cards" style="margin-top: 20px;margin-bottom: 20px;">
        <article class="card card_main">
            <header class="card__header">
                <img class="card__preview" src="{{$Data['globalVariable']['imagesUrl']}}/{{$category->image}}.jpg" style="width:100%" alt="{{$category->image}}.jpg">
            </header>
            <div class="card__body">
                <div class="card__content">

                    @if($Data['sonsExsit'][$index]['NumberOfSons'] > 0)
                        <h3 class="card__title"><a href="{{$Data['globalVariable']['Url']}}/getallcategoriesByParentId/{{$category->id}}/{{Session::get('defaultLanguage')}}" class="card__showmore">{{$category->title}}</a></h3>{{--{{$category['title']}}--}}
                    @else
                        <h3 class="card__title"><a href="{{$Data['globalVariable']['Url']}}/listofitembycategory/{{$category->id}}/{{Session::get('defaultLanguage')}}"  class="card__showmore">{{$category->desc}}</a></h3>{{--{{$category['title']}}--}}
                    @endif

                    <div class="card__description">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis, quisquam, cum, praesentium error cumque voluptas ea architecto necessitatibus impedit quae autem minima consequuntur sed dolor quas labore aut asperiores maxime saepe expedita iusto libero at officia rem sunt. Accusamus, quis?</p>
                    </div>

                </div>
                <footer class="card__footer">
                    <span class="card__author">by Stas Melnikov</span>
                    <div class="card__meta">
                        <div class="card__meta-item">
                            <i class="card__meta-icon card__meta-comments"></i>
                            <span class="card__label">47 comments</span>
                        </div>
                        <div class="card__meta-item">
                            <i class="card__meta-icon card__meta-likes"></i>
                            <span class="card__label">99</span>
                        </div>
                    </div>
                </footer>
            </div>
        </article>
    </div>
    @endforeach
</div>
@endsection
