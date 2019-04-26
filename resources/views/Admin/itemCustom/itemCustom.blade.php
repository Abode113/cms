@extends('Admin.home.home')

@section('title')
    Language
@endsection

<link href="{{ asset('css/itemcustomattr.css') }}" rel="stylesheet" type="text/css" >
<script src="{{ URL::to('js/itemcustomattr.js') }}"></script>

@section('Body')
    <p class="lead">
        <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalAdd" role="button">Add new item custom attribute</a>
    </p>

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">feildsName</th>
            <th scope="col">feildsType</th>
            <th scope="col">created_at</th>
            <th scope="col">updated_at</th>
            <th scope="col">Details</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($Data['itemsCustomAttr'] as $elem)
            <tr>
                <th scope="row">{{$elem->id}}</th>
                <td>{{$elem->name}}</td>
                <td>{{$elem->type }}</td>
                <td>{{$elem->created_at}}</td>
                <td>{{$elem->updated_at}}</td>
                <td>
                    <?php
                    $jsonLang = $elem;
                    $jsonLang = json_encode($jsonLang);
                    ?>
                    <button type="button" data-toggle="modal" data-target="#myModaledit" onclick="assignValTomodel_itemcustomattr('{{$jsonLang}}')" class="btn btn-info">Details</button>
                </td>
                <form class="from-vertical" action="{{route('ItemCustomAttributedelete',$elem->id)}}" method="post">
                    {{ csrf_field() }}
                    <td>
                        <button href="" class="btn btn-danger" type="submit">
                            Delete
                        </button>
                    </td>
                </form>

            </tr>
        @endforeach
        </tbody>
    </table>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="myModalAdd" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">

                    <div class="container">

                        <div class="row">
                            <div class="col-md-12">
                                <h3><small>Add New Custom Attribute</small></h3>
                                <form class="from-vertical" id="customAttrForm" action="{{$Data['globalVariable']['shortUrl']}}/ItemCustomAttribute/store" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <label for="permanent_address" class="col-md-4 col-form-label text-md-right">Name</label>
                                        <div class="col-md-6">
                                            <input type="text" id="name" name="name" class="from-conrol">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="permanent_address" class="col-md-4 col-form-label text-md-right">Type</label>
                                        <div class="col-md-6">
                                            <input type="text" id="type" name="type" class="from-conrol">
                                        </div>
                                    </div>
                                    <div class="tab_container">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col">Check</th>
                                                <th scope="col">name</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($Data['items'] as $elem)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="items[]" value="{{$elem->id}}" class="custom-control-input" id="customCheck{{$elem->id}}" >
                                                                <label class="custom-control-label" for="customCheck{{$elem->id}}" style="padding: 0 !important;"></label>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <td>{{$elem->title}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-6 offset-md-8">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="myModaledit" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">

                    <div class="container">

                        <div class="row">
                            <div class="col-md-12">
                                <h3><small>Edit Custom Attribute</small></h3>
                                <form class="from-vertical" id="_customAttrForm" action="{{$Data['globalVariable']['shortUrl']}}/ItemCustomAttribute/update/" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <label for="permanent_address" class="col-md-4 col-form-label text-md-right">Name</label>
                                        <div class="col-md-6">
                                            <input type="text" id="_name" name="name" class="from-conrol">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="permanent_address" class="col-md-4 col-form-label text-md-right">Type</label>
                                        <div class="col-md-6">
                                            <input type="text" id="_type" name="type" class="from-conrol">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="permanent_address" class="col-md-4 col-form-label text-md-right">Type</label>
                                        <div class="col-md-6">
                                            <h4 id="itemName"></h4>
                                        </div>
                                    </div>

                                    <div class="col-md-6 offset-md-8">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



@endsection




