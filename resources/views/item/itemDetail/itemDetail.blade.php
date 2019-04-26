@extends('view.HomePage.home')

@section('title')
    item per page
@endsection

@section('metaDescription')
    {{$Data['allItems']->desc}}
@endsection

<link href="{{ asset('css/itemDetails.css') }}" rel="stylesheet" type="text/css" >

@section('Body')
<div class="containerfluid">
    <div class="banner" style="width:100%;">
        <img src="{{$Data['globalVariable']['imagesUrl']}}/{{$Data['allItems']->coverimage}}.jpg" style="width: 100%;max-height: 300px;" class="fit banner-image" alt="{{$Data['allItems']->coverimage}}.jpg" >
        <div class="banner-title">
            <h1>{{$Data['allItems']->title}}</h1>
        </div>
        <div class="profile-container" style="">
            <div class="profile-image overflow-centered">
                <img src="{{$Data['globalVariable']['imagesUrl']}}/{{$Data['allItems']->image}}.jpg" class="fit" alt="{{$Data['allItems']->image}}.jpg" />
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <ul class="nav nav-pills nav-stacked col-md-1">
            <li role="presentation" class="active text-center"><a href="#">A</a></li>
            <li role="presentation" class="text-center"><a href="#">B</a></li>
            <li role="presentation" class="text-center"><a href="#">C</a></li>
        </ul>
        <div class="content col-md-10" style="font-size: 16px">{{$Data['allItems']->info}}</div>
        <div class="content col-md-10" style="font-size: 16px">{{$Data['allItems']->desc}}</div>
    </div>
</div>
@endsection


