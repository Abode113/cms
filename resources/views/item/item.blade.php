@extends('view.HomePage.home')

@section('title')
    list of items
@endsection
@if(array_key_exists("fatherObj",$Data))
@section('metaDescription')
    {{$Data['fatherObj']->desc}}
@endsection
@endif

<link href="{{ asset('css/item.css') }}" rel="stylesheet" type="text/css" >

@section('Body')
<div class="container">
    <div class="row">
        @foreach($Data['allItems'] as $item)
        <div class="col-md-4">
             <div class="card profile-card-5">
                 <div class="card-img-block">
                     <img class="card-img-top" src="{{$Data['globalVariable']['imagesUrl']}}/{{$item->image}}.jpg" alt="{{$item->image}}.jpg">
                 </div>
                 <div class="card-body pt-0">
                     <h5 class="card-title">{{$item->title}}</h5>
                     <p class="card-text">{{$item->desc}}</p>
                     <a href="{{$Data['globalVariable']['Url']}}/item/{{$item->id}}/{{Session::get('defaultLanguage')}}" class="btn btn-primary">{{$Data['Words']['Detail_en']->word}}</a>
                 </div>
             </div>
             <p class="mt-3 w-100 float-left text-center"><strong>Card with Floting Picture</strong></p>
        </div>
        @endforeach
    </div>
</div>
@endsection
