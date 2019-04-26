@extends('Admin.home.home')

@section('title')
    store Category
@endsection

<link href="{{ asset('css/storecategory.css') }}" rel="stylesheet" type="text/css" >
<script src="{{ URL::to('js/adminitem.js') }}"></script>

@section('Body')
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
                                    @foreach($Data['allLang'] as $Lang)
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
                    <form class="from-vertical" action="{{$Data['globalVariable']['shortUrl']}}/category/store" method="post">
                        <div class="card-body ">
                            <div class="tab-content text-center">

                                @foreach($Data['allLang'] as $Lang)
                                    <div class="tab-pane" id="{{$Lang->LanguageName}}">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        {{ csrf_field() }}
                                                        <div class="form-group row">
                                                            <label for="full_name" class="col-md-4 col-form-label text-md-right">title</label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="title_lang_{{$Lang->id}}" class="from-conrol">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="full_name" class="col-md-4 col-form-label text-md-right">desc</label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="desc_lang_{{$Lang->id}}" class="from-conrol">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="full_name" class="col-md-4 col-form-label text-md-right">info</label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="info_lang_{{$Lang->id}}" class="from-conrol">
                                                            </div>
                                                        </div>
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
                                            <label for="email_address" class="col-md-4 col-form-label text-md-right">image</label>
                                            <div class="col-md-6">
                                                <input type="text" name="image" class="from-conrol">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email_address" class="col-md-4 col-form-label text-md-right">coverimage</label>
                                            <div class="col-md-6">
                                                <input type="text" name="coverimage" class="from-conrol">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email_address" class="col-md-4 col-form-label text-md-right">parent</label>
                                            <div class="from-conrol">

                                                <select class="custom-select" name="parent" >
                                                    <option value="0">{{"First One"}}</option>
                                                    @foreach($Data['category'] as $category)

                                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="user_name" class="col-md-4 col-form-label text-md-right">categoryOrder</label>
                                            <div class="col-md-6">
                                                <input type="text" name="categoryOrder" class="from-conrol">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="permanent_address" class="col-md-4 col-form-label text-md-right">event_id</label>
                                            <div class="col-md-6">
                                                <input type="text" name="event_id" class="from-conrol">
                                            </div>
                                        </div>

                                        <div class="col-md-6 offset-md-8">
                                            <button type="submit" class="btn btn-success">Add MenuItem</button>
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
