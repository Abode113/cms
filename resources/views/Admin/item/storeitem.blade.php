@extends('Admin.home.home')

@section('title')
    Store Item
@endsection

<link href="{{ asset('css/storeitem.css') }}" rel="stylesheet" type="text/css" >
<script src="{{ URL::to('js/adminitem.js') }}"></script>

@section('Body')

    <?php
    //dd($Data['category'][0]->id);
    ?>
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h3><small>Tabs with Icons on Card</small></h3>

                <!-- Tabs with icons on Card -->
                <div class="card card-nav-tabs">
                    <div class="card-header card-header-info">
                        <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    @foreach($Data['Languages'] as $Lang)
                                        <li class="nav-item">
                                            <a class="nav-link" href="#{{$Lang->LanguageName}}" data-toggle="tab">
                                                {{$Lang->LanguageName}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                        <form class="from-vertical" action="{{$Data['globalVariable']['shortUrl']}}/item/store" method="post">
                            {{ csrf_field() }}
                            <div class="card-body ">
                                <div class="tab-content text-center">

                                    @foreach($Data['Languages'] as $Lang)
                                        <div class="tab-pane" id="{{$Lang->LanguageName}}">
                                            <div class="row justify-content-center">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            {{ csrf_field() }}
                                                            <div class="form-group row">
                                                                <label class="col-md-4 col-form-label text-md-right">title</label>
                                                                <div class="col-md-6">
                                                                    <input type="text" name="title_lang_{{$Lang->id}}" class="from-conrol">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-md-4 col-form-label text-md-right">desc</label>
                                                                <div class="col-md-6">
                                                                    <input type="text" name="desc_lang_{{$Lang->id}}" class="from-conrol">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-md-4 col-form-label text-md-right">info</label>
                                                                <div class="col-md-6">
                                                                    <input type="text" name="info_lang_{{$Lang->id}}" class="from-conrol">
                                                                </div>
                                                            </div>
                                                            @foreach($Data['CatCustomAttr'] as $elem)
                                                                <div class="form-group row">
                                                                    <label class="col-md-4 col-form-label text-md-right">{{$elem->name}}</label>
                                                                    <div class="col-md-6">
                                                                        <input type="text" name="{{$elem->name}}_lang_{{$Lang->id}}_Value_{{$elem->id}}" class="from-conrol">
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="col-md-6 offset-md-8">
                                                            <button class="btn btn-success">Submit Lang</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-md-12">
                                        <div class="card">

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">image</label>
                                <div class="col-md-6">
                                    <input type="text" name="image" class="from-conrol">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">coverimage</label>
                                <div class="col-md-6">
                                    <input type="text" name="coverimage" class="from-conrol">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">visible</label>
                                <div class="col-md-6">
                                    <label class="switch">
                                        <input type="checkbox" value=""  id="checboxvisibleitem"  onclick="visiblefunctioniteminstore()" >
                                        <span class="slider round"></span>
                                    </label>
                                    <input type="hidden" name="visible" id="visible" value="0" class="from-conrol">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">itemOrder</label>
                                <div class="col-md-6">
                                    <input type="text" name="itemOrder" class="from-conrol">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">category_id</label>
                                <div class="from-conrol">

                                    <select id="categorySelect" class="custom-select" name="category_id">

                                        @foreach($Data['category'] as $category)
                                            @if($category->id == $Data['CatDefaultId'])
                                                <option value="{{$category->id}}" onclick="refresh('{{$category->id}}')">{{$category->title}}</option>
                                            @endif
                                        @endforeach
                                        @foreach($Data['category'] as $category)
                                            @if($category->id != $Data['CatDefaultId'])
                                                <option value="{{$category->id}}" onclick="refresh('{{$category->id}}')">{{$category->title}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">event_id</label>
                                <div class="col-md-6">
                                    <input type="text" name="event_id" class="from-conrol">
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                </div>
            </div>
        </div>
    </div>
                    </form>
                </div>
                <!-- End Tabs with icons on Card -->

            </div>
        </div>
    </div>
@endsection
