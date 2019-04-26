@extends('Admin.home.home')

@section('title')
    Items
@endsection

<link href="{{ asset('css/adminitem.css') }}" rel="stylesheet" type="text/css" >
<script src="{{ URL::to('js/adminitem.js') }}"></script>

@section('Body')
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="{{$Data['globalVariable']['Url']}}/item/store/0" role="button">Add new items</a>
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
            {{--<th scope="col">desc</th>--}}
            {{--<th scope="col">info</th>--}}
            {{--<th scope="col">image</th>--}}
            {{--<th scope="col">coverimage</th>--}}
            <th scope="col">visible</th>
            <th scope="col">itemOrder</th>
            <th scope="col">category_id</th>
            {{--<th scope="col">event_id</th>--}}
            <th scope="col">created_at</th>
            <th scope="col">updated_at</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($Data['items'] as $item)
                @if($item->LanguageId == $language->id)
            <tr>
            
                <th scope="row">{{$item->id}}</th>
                <td class="info-td">{{$item->title}}</td>
                {{--<td class="info-td">{{$item['desc']}}</td>--}}
                {{--<td class="info-td">{{$item['info']}}</td>--}}
                {{--<td class="info-td">{{$item['image']}}</td>--}}
                {{--<td class="info-td">{{$item['coverimage']}}</td>--}}
                <td class="info-td">{{$item->visible}}</td>
                <td class="info-td">{{$item->itemOrder}}</td>
                <td class="info-td">{{$item->category_id}}</td>
                {{--<td class="info-td">{{$item['event_id}}</td>--}}
                <td class="info-td">{{$item->created_at}}</td>
                <td class="info-td">{{$item->updated_at}}</td>
                <td>
                    <?php
                    $jsonItem = array();
                    $values = array();
                    array_push($jsonItem, $item);
                    ?>
                    @foreach($Data['items'] as $Sameitem)
                        @if($item->id == $Sameitem->id && $item->LanguageId != $Sameitem->LanguageId)
                            <?php
                            array_push($jsonItem, $Sameitem);
                            ?>
                        @endif
                    @endforeach
                    <?php
                        $jsonItem =json_encode($jsonItem);
                    ?>
                    <button type="button" data-toggle="modal" data-target="#myModal" onclick="hey({{$jsonItem}})" class="btn btn-info">Details</button>
                </td>
                <form class="from-vertical" action="{{route('itemdelete',$item->id)}}" method="post">
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
                                                    @foreach($Data['Languages'] as $Lang)
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


                                    <form class="from-vertical" id="modalForm" action="{{$Data['globalVariable']['shortUrl']}}/item/update/" method="post">
                                        {{ csrf_field() }}
                                        <div class="card-body ">
                                            <div class="tab-content text-center">

                                                @foreach($Data['Languages'] as $language)
                                                    <div class="tab-pane" id="{{$language->LanguageName}}">
                                                        <div class="row justify-content-center">
                                                            <div class="col-md-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        {{ csrf_field() }}
                                                                        <div class="form-group row">
                                                                            <label class="col-md-4 col-form-label text-md-right">title</label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" name="title_lang_{{$language->id}}" id="title_lang_{{$language->LanguageName}}" class="from-conrol" style="display: block">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-md-4 col-form-label text-md-right">desc</label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" name="desc_lang_{{$language->id}}" id="desc_lang_{{$language->LanguageName}}" class="from-conrol" style="display: block">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-md-4 col-form-label text-md-right">info</label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" name="info_lang_{{$language->id}}" id="info_lang_{{$language->LanguageName}}" class="from-conrol" style="display: block">
                                                                            </div>
                                                                        </div>
                                                                        <div id="dynamicFeilds_{{$language->id}}"></div>
                                                                        <div id="dynamicCustomFeilds_{{$language->id}}"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-md-12">
                                                    <div class="card">

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">image</label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="image" id="image" class="from-conrol" value="">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">coverimage</label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="coverimage" id="coverimage" class="from-conrol" value="">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">visible</label>
                                                            <div class="col-md-6">
                                                                <label class="switch">
                                                                    <input type="checkbox" value=""  id="checboxvisibleitem"  onclick="visiblefunctionitem({{$jsonItem}})" >
                                                                    <span class="slider round"></span>
                                                                </label>
                                                                <input type="hidden" name="visible" id="visible" value="0" class="from-conrol">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">itemOrder</label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="itemOrder" id="itemOrder" class="from-conrol" value="">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">category_id</label>
                                                            <div class="from-conrol">

                                                                <select class="custom-select" name="category_id" >

                                                                    @foreach($Data['category'] as $category)

                                                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label text-md-right">event_id</label>
                                                            <div class="col-md-6">
                                                                <input type="text" name="event_id" id="event_id" class="from-conrol" value="">
                                                            </div>
                                                        </div>
                                                        {{--<p class="lead">--}}
                                                            {{--<a class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModalAdd" role="button">Add custom Attribute</a>--}}
                                                        {{--</p>--}}
                                                        <div class="col-md-6 offset-md-8">
                                                            <button type="submit" class="btn btn-success">Edit</button>
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
                                <form class="from-vertical" id="customAttrForm" action="{{$Data['globalVariable']['shortUrl']}}/ItemCustomAttribute/store/" method="post">
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
