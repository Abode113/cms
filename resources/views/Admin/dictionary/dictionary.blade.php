@extends('Admin.home.home')

@section('title')
    Dictionary
@endsection

<link href="{{ asset('css/Dictionary.css') }}" rel="stylesheet" type="text/css" >
<script src="{{ URL::to('js/Dictionary.js') }}"></script>

@section('Body')
    <p class="lead">
        <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalAdd" role="button">Add new Word</a>
    </p>

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">word </th>
            <th scope="col">created_at</th>
            <th scope="col">updated_at</th>
            <th scope="col">Details</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($Data['dictionary'] as $elem)
            <tr>
                <th scope="row">{{$elem->id}}</th>
                <td>{{$elem->word }}</td>
                <td>{{$elem->created_at}}</td>
                <td>{{$elem->updated_at}}</td>
                <td>
                    <?php
                    $jsonDictionary_id = $elem->id;
                    $jsonDictionary_id = json_encode($jsonDictionary_id);

                    $jsonData = $Data['AllData'];
                    $jsonData = json_encode($jsonData);
                    ?>
                    <button type="button" data-toggle="modal" data-target="#myModaledit" onclick="assignValTomodel_dictionaries('{{$jsonDictionary_id}}', '{{$jsonData}}')" class="btn btn-info">Details</button>
                </td>
                <form class="from-vertical" action="{{route('Dictionarydelete',$elem->id)}}" method="post">
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
                                <h3><small>Add Words To Dictionary</small></h3>
                                <form class="from-vertical" action="{{$Data['globalVariable']['shortUrl']}}/Dictionary/store" method="post">
                                    {{ csrf_field() }}
                                    @foreach($Data['Languages'] as $elem)
                                        <div class="form-group row">
                                            <label for="permanent_address" class="col-md-4 col-form-label text-md-right">{{$elem->LanguageName}}</label>
                                            <div class="col-md-6">
                                                <input type="text" name="word_lang_{{$elem->id}}" class="from-conrol">
                                            </div>
                                        </div>
                                    @endforeach
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
                                <h3><small>Add New Language</small></h3>
                                <form id="modalForm" class="from-vertical" action="{{$Data['globalVariable']['shortUrl']}}/Dictionary/update/" method="post">
                                    {{ csrf_field() }}
                                    @foreach($Data['Languages'] as $elem)
                                        <div class="form-group row">
                                            <label for="permanent_address" class="col-md-4 col-form-label text-md-right">{{$elem->LanguageName}}</label>
                                            <div class="col-md-6">
                                                <input type="text" id="word_lang_{{$elem->id}}" name="word_lang_{{$elem->id}}" class="from-conrol">
                                            </div>
                                        </div>
                                    @endforeach

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




