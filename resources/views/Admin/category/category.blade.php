@extends('Admin.home.home')

@section('title')
    Category
@endsection

<link href="{{ asset('css/adminmenuitem.css') }}" rel="stylesheet" type="text/css" >
<script src="{{ URL::to('js/admincategory.js') }}"></script>

@section('Body')
    <?php
    $allCateId = array();
    $allCatetitle = array();

    foreach($Data['category'] as $item){
        if(!in_array($item->id, $allCateId)){
            array_push($allCateId, $item->id);
            array_push($allCatetitle, $item->title);
        }
    }

    $allCateIdjs = json_encode($allCateId);
    $allCatetitlejs = json_encode($allCatetitle);
    ?>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="{{$Data['globalVariable']['Url']}}/category/store" role="button">Add new Category</a>
    </p>

    <div class="tab_container">
        @foreach($Data['Languages'] as $language)
            <input id="tab{{$language->id}}" type="radio" name="tabs">
            <label for="tab{{$language->id}}"><i class="fa fa-code"></i><span>{{$language->LanguageName}}</span></label>
        @endforeach
        @foreach($Data['Languages'] as $language)
            <section id="content{{$language->id}}" class="tab-content">
                <h3>{{$language->LanguageName}}</h3>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">title</th>
                        <th scope="col">image</th>
                        <th scope="col">Cover image</th>
                        <th scope="col">parent</th>
                        <th scope="col">categoryOrder</th>
                        <th scope="col">event_id</th>
                        <th scope="col">created_at</th>
                        <th scope="col">updated_at</th>
                        <th scope="col">Details</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Data['category'] as $item)
                        @if($item->LanguageId == $language->id)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->title}}</td>
                                <td>{{$item->image}}</td>
                                <td>{{$item->coverimage}}</td>
                                <td>{{$item->parent}}</td>
                                <td>{{$item->categoryOrder}}</td>
                                {{--<td>{{$item['type']}}</td>--}}
                                <td>{{$item->event_id}}</td>
                                {{--<td>{{$item['event_id']}}</td>--}}
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->updated_at}}</td>
                                <td>
                                    <?php
                                    $jsonItem = array();
                                    array_push($jsonItem, $item);
                                    ?>
                                    @foreach($Data['category'] as $Sameitem)
                                        @if($item->id == $Sameitem->id && $item->LanguageId != $Sameitem->LanguageId)
                                            <?php
                                            array_push($jsonItem, $Sameitem);
                                            ?>
                                        @endif
                                    @endforeach
                                    <?php
                                    $jsonItem =json_encode($jsonItem)
                                    ?>
                                    <button type="button" data-toggle="modal" data-target="#myModal" onclick="assignValTomodel('{{$jsonItem}}', '{{$item->id}}', '{{$allCateIdjs}}', '{{$allCatetitlejs}}')" class="btn btn-info">Details</button>
                                </td>
                                <form class="from-vertical" action="{{route('categorydelete',$item->id)}}" method="post">
                                    {{ csrf_field() }}
                                    <td>
                                        <button href="" class="btn btn-danger" type="submit">
                                            Delete
                                        </button>
                                    </td>
                                </form>

                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </section>
        @endforeach
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
                                    <div class="card-header card-header-info">
                                        <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                                        <div class="nav-tabs-navigation">
                                            <div class="nav-tabs-wrapper">
                                                <ul class="nav nav-tabs" data-tabs="tabs">
                                                    @foreach($Data['Languages'] as $language)
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="#{{$language->LanguageName}}" data-toggle="tab">
                                                                {{$language->LanguageName}}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <form class="from-vertical" id="modalForm" action="{{$Data['globalVariable']['shortUrl']}}/category/update/" method="post">
                                        {{ csrf_field() }}
                                        <div class="card-body ">
                                            <div class="tab-content text-center">
                                                @foreach($Data['Languages'] as $language)
                                                    <div class="tab-pane" id="{{$language->LanguageName}}">
                                                        <div class="row justify-content-center">
                                                            <div class="col-md-12">
                                                                <div class="card">
                                                                    <div class="card-body">

                                                                        <div class="form-group row">
                                                                            <label for="full_name" class="col-md-4 col-form-label text-md-right">title</label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" name="title_lang_{{$language->id}}" class="from-conrol" id="title_{{$language->LanguageName}}" value="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="full_name" class="col-md-4 col-form-label text-md-right">desc</label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" name="desc_lang_{{$language->id}}" class="from-conrol" id="desc_{{$language->LanguageName}}" value="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label for="full_name" class="col-md-4 col-form-label text-md-right">info</label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" name="info_lang_{{$language->id}}" class="from-conrol" id="info_{{$language->LanguageName}}" value="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 offset-md-8">
                                                                        <button class="btn btn-success">Edit</button>
                                                                        <button class="btn btn-success">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="form-group row">
                                                            <label for="user_name" class="col-md-4 col-form-label text-md-right">image</label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="image" id="image" value="" class="from-conrol">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="user_name" class="col-md-4 col-form-label text-md-right">coverimage</label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="coverimage" id="coverimage" value="" class="from-conrol">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">

                                                            <label for="email_address" class="col-md-4 col-form-label text-md-right">parent</label>
                                                            <div class="from-conrol">
                                                                <select id="parent" class="custom-select" name="parent">
                                                                    @foreach($allCateId as $elem)
                                                                        <option id="opt{{$elem}}" value="{{$elem}}"></option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="user_name" class="col-md-4 col-form-label text-md-right">Category Order</label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="categoryOrder" id="categoryOrder" value="" class="from-conrol">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="permanent_address" class="col-md-4 col-form-label text-md-right">event_id</label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="event_id" id="event_id" value="" class="from-conrol">
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
