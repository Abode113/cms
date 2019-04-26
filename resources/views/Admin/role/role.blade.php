@extends('Admin.home.home')

@section('title')
    Roles
@endsection

<link href="{{ asset('css/Role.css') }}" rel="stylesheet" type="text/css" >
<script src="{{ URL::to('js/Role.js') }}"></script>

@section('Body')

    <p class="lead">
        <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalAdd" role="button">Add new Role</a>
    </p>

    <div class="tab_container">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
                <th scope="col">display_name</th>
                <th scope="col">description </th>
                <th scope="col">created_at</th>
                <th scope="col">updated_at</th>
                <th scope="col">Details</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($Data['RoleData'] as $elem)
                <tr>
                    <th scope="row">{{$elem->id}}</th>
                    <td>{{$elem->name}}</td>
                    <td>{{$elem->display_name}}</td>
                    <td>{{$elem->description }}</td>
                    <td>{{$elem->created_at}}</td>
                    <td>{{$elem->updated_at}}</td>
                    <td>
                        <?php
                        //dd($elem);
                        $RoleJs = json_encode($elem);
                        ?>
                        <button type="button" data-toggle="modal" data-target="#myModaledit" onclick="assignValTomodel_Role('{{$RoleJs}}')" class="btn btn-info">Details</button>
                    </td>
                    <form class="from-vertical" action="{{route('Roledelete',$elem->id)}}" method="post">
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
                                <h3><small>Add New Role</small></h3>
                                <form class="from-vertical" action="{{$Data['globalVariable']['shortUrl']}}/Role/store" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <label for="permanent_address" class="col-md-4 col-form-label text-md-right">Role Name</label>
                                        <div class="col-md-6">
                                            <input type="text" name="name" class="from-conrol">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="permanent_address" class="col-md-4 col-form-label text-md-right">display name</label>
                                        <div class="col-md-6">
                                            <input type="text" name="display_name" class="from-conrol">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="permanent_address" class="col-md-4 col-form-label text-md-right">description</label>
                                        <div class="col-md-6">
                                            <input type="text" name="description" class="from-conrol">
                                        </div>
                                    </div>


                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">Check</th>
                                            <th scope="col">name</th>
                                            <th scope="col">display_name</th>
                                            <th scope="col">description </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($Data['Permissions'] as $elem)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" name="Permissions[]" value="{{$elem->id}}" class="custom-control-input" id="customCheck{{$elem->id}}" >
                                                            <label class="custom-control-label" for="customCheck{{$elem->id}}" style="padding: 0 !important;"></label>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td>{{$elem->name}}</td>
                                                <td>{{$elem->display_name}}</td>
                                                <td>{{$elem->description}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>



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
                                <h3><small>Edit Role</small></h3>
                                <form id="modalForm" class="from-vertical" action="{{$Data['globalVariable']['shortUrl']}}/Role/update/" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <label for="permanent_address" class="col-md-4 col-form-label text-md-right">Role Name</label>
                                        <div class="col-md-6">
                                            <input id="name" type="text" name="name" class="from-conrol">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="permanent_address" class="col-md-4 col-form-label text-md-right">Role display</label>
                                        <div class="col-md-6">
                                            <input id="display_name" type="text" name="display_name" class="from-conrol">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="permanent_address" class="col-md-4 col-form-label text-md-right">Role description</label>
                                        <div class="col-md-6">
                                            <input id="description" type="text" name="description" class="from-conrol">
                                        </div>
                                    </div>

                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">Check</th>
                                            <th scope="col">name</th>
                                            <th scope="col">display_name</th>
                                            <th scope="col">description </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($Data['Permissions'] as $elem)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" name="Permissions[]" value="{{$elem->id}}" class="custom-control-input" id="_customCheck{{$elem->id}}" >
                                                            <label class="custom-control-label" for="_customCheck{{$elem->id}}" style="padding: 0 !important;"></label>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td>{{$elem->name}}</td>
                                                <td>{{$elem->display_name}}</td>
                                                <td>{{$elem->description}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>


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

