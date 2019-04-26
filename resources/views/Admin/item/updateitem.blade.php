@extends('Admin.home.home')

@section('title')
    update Item
@endsection

<link href="{{ asset('css/updateitem.css') }}" rel="stylesheet" type="text/css" >

@section('Body')
<main class="my-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">update item</div>
                    <div class="card-body">
                        <form class="from-vertical" action="{{route('itemupdate',$Data['obj']->id)}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="full_name" class="col-md-4 col-form-label text-md-right">title</label>
                                <div class="col-md-6">
                                    <input type="text" name="title" class="from-conrol" value="{{$Data['obj']->title}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="full_name" class="col-md-4 col-form-label text-md-right">info</label>
                                <div class="col-md-6">
                                    <input type="text" name="info" class="from-conrol" value="{{$Data['obj']->info}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="full_name" class="col-md-4 col-form-label text-md-right">desc</label>
                                <div class="col-md-6">
                                    <input type="text" name="desc" class="from-conrol" value="{{$Data['obj']->desc}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="full_name" class="col-md-4 col-form-label text-md-right">image</label>
                                <div class="col-md-6">
                                    <input type="text" name="image" class="from-conrol" value="{{$Data['obj']->image}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="full_name" class="col-md-4 col-form-label text-md-right">coverimage</label>
                                <div class="col-md-6">
                                    <input type="text" name="coverimage" class="from-conrol" value="{{$Data['obj']->coverimage}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-right">visible</label>
                                <div class="col-md-6">
                                    <input type="text" name="visible" class="from-conrol" value="{{$Data['obj']->visible}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="present_address" class="col-md-4 col-form-label text-md-right">itemOrder</label>
                                <div class="col-md-6">
                                    <input type="text" name="itemOrder" class="from-conrol" value="{{$Data['obj']->itemOrder}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="permanent_address" class="col-md-4 col-form-label text-md-right">category_id</label>
                                <div class="col-md-6">
                                    <input type="text" name="category_id" class="from-conrol" value="{{$Data['obj']->category_id}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="permanent_address" class="col-md-4 col-form-label text-md-right">event_id</label>
                                <div class="col-md-6">
                                    <input type="text" name="event_id" class="from-conrol" value="{{$Data['obj']->event_id}}">
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

</main>
@endsection

