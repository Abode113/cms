@extends('Admin.home.home')

@section('title')
    store category custom attribute
@endsection

<link href="{{ asset('css/storeCatCustomAttr.css') }}" rel="stylesheet" type="text/css" >
{{--<script src="{{ URL::to('js/adminitem.js') }}"></script>--}}

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
                                <ul class="nav nav-tabs" data-tabs="tabs"></ul>
                            </div>
                        </div>
                    </div>
                    <form class="from-vertical" action="{{$Data['globalVariable']['shortUrl']}}/CatCustomAttr/store" method="post">
                        {{ csrf_field() }}
                        <div class="card-body ">
                            <div class="tab-content text-center">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="form-group row">
                                            <label for="permanent_address" class="col-md-4 col-form-label text-md-right">name</label>
                                            <div class="col-md-6">
                                                <input type="text" name="name" class="from-conrol">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="permanent_address" class="col-md-4 col-form-label text-md-right">type</label>
                                            <div class="col-md-6">
                                                <input type="text" name="type" class="from-conrol">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="permanent_address" class="col-md-4 col-form-label text-md-right">category_id</label>
                                            <div class="from-conrol">

                                                <select class="custom-select" name="category_id" >

                                                    @foreach($Data['category'] as $category)

                                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 offset-md-8">
                                            <button type="submit" class="btn btn-success">Add Category Custom Attribute</button>
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
