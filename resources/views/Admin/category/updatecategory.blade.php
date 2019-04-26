@extends('Admin.home.home')

@section('title')
    update Category
@endsection

<link href="{{ asset('css/updatecategory.css') }}" rel="stylesheet" type="text/css" >

@section('Body')
<main class="my-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">update category</div>
                    <div class="card-body">
                        <form class="from-vertical" action="{{route('categoryupdate',$Data['Obj']->id)}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="full_name" class="col-md-4 col-form-label text-md-right">title</label>
                                <div class="col-md-6">
                                    <input type="text" name="title" class="from-conrol" value="{{$Data['Obj']->title}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="full_name" class="col-md-4 col-form-label text-md-right">desc</label>
                                <div class="col-md-6">
                                    <input type="text" name="desc" class="from-conrol" value="{{$Data['Obj']->desc}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="full_name" class="col-md-4 col-form-label text-md-right">info</label>
                                <div class="col-md-6">
                                    <input type="text" name="info" class="from-conrol" value="{{$Data['Obj']->info}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="full_name" class="col-md-4 col-form-label text-md-right">image</label>
                                <div class="col-md-6">
                                    <input type="text" name="image" class="from-conrol" value="{{$Data['Obj']->image}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="full_name" class="col-md-4 col-form-label text-md-right">coverimage</label>
                                <div class="col-md-6">
                                    <input type="text" name="coverimage" class="from-conrol" value="{{$Data['Obj']->coverimage}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">parent</label>
                                <div class="col-md-6">
                                    <input type="text" name="parent" class="from-conrol" value="{{$Data['Obj']->parent}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_name" class="col-md-4 col-form-label text-md-right">categoryOrder</label>
                                <div class="col-md-6">
                                    <input type="text" name="categoryOrder" class="from-conrol" value="{{$Data['Obj']->categoryOrder}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-right">event_id</label>
                                <div class="col-md-6">
                                    <input type="text" name="event_id" class="from-conrol" value="{{$Data['Obj']->event_id}}">
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
