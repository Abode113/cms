@extends('Admin.home.home')

@section('title')
    category custom attribute
@endsection

<link href="{{ asset('css/adminmenuitem.css') }}" rel="stylesheet" type="text/css" >
<script src="{{ URL::to('js/admincatcustomattr.js') }}"></script>

@section('Body')


    <p class="lead">
        <a class="btn btn-primary btn-lg" href="{{$Data['globalVariable']['Url']}}/CatCustomAttr/store" role="button">Add new Category Custom Attribute</a>
    </p>

    <div class="tab_container">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
                <th scope="col">type</th>
                <th scope="col">category_id</th>
                <th scope="col">created_at</th>
                <th scope="col">updated_at</th>
                <th scope="col">Details</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($Data['CatCustomAttr'] as $elem)
                <tr>
                    <th scope="row">{{$elem->id}}</th>
                    <td>{{$elem->name}}</td>
                    <td>{{$elem->type}}</td>
                    <td>{{$elem->title}}</td>
                    <td>{{$elem->created_at}}</td>
                    <td>{{$elem->updated_at}}</td>
                    <td>
                        <?php
                        $CatCustomAttrJS = json_encode($Data["CatCustomAttr"]);
                        ?>
                        <button type="button" data-toggle="modal" data-target="#myModal" onclick="assignValTomodel_catcustomattr('{{$CatCustomAttrJS}}', '{{$elem->id}}')" class="btn btn-info">Details</button>
                    </td>
                    <form class="from-vertical" action="{{route('CatCustomAttrdelete',$elem->id)}}" method="post">
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
    <div class="modal fade" id="myModal" role="dialog">
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
                                <h3><small>Tabs with Icons on Card</small></h3>

                                <!-- Tabs with icons on Card -->
                                <div class="card card-nav-tabs">
                                    <form class="from-vertical" id="modalForm" action="{{$Data['globalVariable']['shortUrl']}}/CatCustomAttr/update/" method="post">
                                        {{ csrf_field() }}
                                        <div class="card-body ">
                                            <div class="tab-content text-center">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="form-group row">
                                                            <label for="user_name" class="col-md-4 col-form-label text-md-right">name</label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="name" id="name" value="" class="from-conrol">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="user_name" class="col-md-4 col-form-label text-md-right">type</label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="type" id="type" value="" class="from-conrol">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="permanent_address" class="col-md-4 col-form-label text-md-right">category_id</label>
                                                            <div class="from-conrol">

                                                                <select id="category_id" class="custom-select" name="category_id" >

                                                                    @foreach($Data['category'] as $category)

                                                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 offset-md-8">
                                                            <button type="submit" class="btn btn-success">Edit</button>
                                                            <button type="submit" class="btn btn-success" disabled="disabled">Submit</button>
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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

@endsection
