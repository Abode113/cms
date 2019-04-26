@extends('Admin.home.home')

@section('title')
    Users
@endsection

<link href="{{ asset('css/User.css') }}" rel="stylesheet" type="text/css" >
<script src="{{ URL::to('js/User.js') }}"></script>

@section('Body')

    <div class="tab_container">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
                <th scope="col">email </th>
                <th scope="col">created_at</th>
                <th scope="col">updated_at</th>
                <th scope="col">Role</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($Data['Users'] as $elem)
                <tr>
                    <th scope="row">{{$elem->id}}</th>
                    <td>{{$elem->name}}</td>
                    <td>{{$elem->email }}</td>
                    <td>{{$elem->created_at}}</td>
                    <td>{{$elem->updated_at}}</td>
                    <td>
                        <?php
                        //dd($Data['RoleData']);
                        //dd($elem);
                        $RolesJs = json_encode($Data['RoleData']);
                        $UserJs = json_encode($elem);
                        ?>
                        <button type="button" data-toggle="modal" data-target="#myModalRole" onclick="assignValTomodel_User('{{$UserJs}}', '{{$RolesJs}}')" class="btn btn-info">Details</button>
                    </td>
                    <form class="from-vertical" action="{{route('Userdelete',$elem->id)}}" method="post">
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
    <div class="modal fade" id="myModalRole" role="dialog">
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
                                <h3><small>Chose Role to add</small></h3>
                                <form id="modalForm" class="from-vertical" action="{{$Data['globalVariable']['shortUrl']}}/User/AddRole/" method="post">
                                    {{ csrf_field() }}
                                    <div class="tab_container">
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
                                            @foreach($Data['RoleData'] as $elem)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="roles[]" value="{{$elem->id}}" class="custom-control-input" id="customCheck{{$elem->id}}" >
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

