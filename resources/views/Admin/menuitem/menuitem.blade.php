@extends('Admin.home.home')

@section('title')
    MenuItems
@endsection

<link href="{{ asset('css/adminmenuitem.css') }}" rel="stylesheet" type="text/css" >
<script src="{{ URL::to('js/adminmenuitem.js') }}"></script>
@section ('styles')
    <style>
        div.sortIt { width: 120px; background-color: #44c756; font-family: Verdana;
            float: left; margin: 4px; text-align: center; border: medium solid #999;
            padding: 4px; color:#eee; box-shadow:5px 5px 5px #444;}

    </style>
    <style> body.dragging, body.dragging * {
            cursor: move !important;
        }

        .dragged {
            position: absolute;
            opacity: 0.5;
            z-index: 2000;
        }

        ol.example li.placeholder {
            position: relative;
            /** More li styles **/
        }
        ol.example li.placeholder:before {
            position: absolute;
            /** Define arrowhead **/
        }</style>

@endsection
@section('Body')


    <?php
    $allMenuId = array();
    $allMenutitle = array();

    foreach($Data['MenuItem'] as $item){
        if(!in_array($item->id, $allMenuId)){
            array_push($allMenuId, $item->id);
            array_push($allMenutitle, $item->title);
        }
    }

    $allMenuIdjs = json_encode($allMenuId);
    $allMenutitlejs = json_encode($allMenutitle);
    ?>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="{{$Data['globalVariable']['Url']}}/menuitem/store" role="button">Add new Menu items</a>
        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalOrder"  role="button" id="orderBtn" onclick="test()" style="color: #fff;">Order</button>
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
                    <th scope="col">parent</th>
                    <th scope="col">navOrder</th>
                    {{--<th scope="col">type</th>--}}
                    <th scope="col">visible</th>
                    <th scope="col">category_id</th>
                    {{--<th scope="col">event_id</th>--}}
                    <th scope="col">created_at</th>
                    <th scope="col">updated_at</th>
                    <th scope="col">Details</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($Data['MenuItem'] as $item)
                    @if($item->LanguageId == $language->id)
                        <tr>
                            <th scope="row">{{$item->id}}</th>
                            <td>{{$item->title}}</td>
                            <td>{{$item->parent}}</td>
                            <td>{{$item->navOrder}}</td>
                            {{--<td>{{$item['type']}}</td>--}}
                            <td>{{$item->visible}}</td>
                            <td>{{$item->category_id}}</td>
                            {{--<td>{{$item['event_id']}}</td>--}}
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->updated_at}}</td>
                            <td>
                                <?php
                                $jsonItem = array();
                                array_push($jsonItem, $item);
                                ?>
                                @foreach($Data['MenuItem'] as $Sameitem)
                                    @if($item->id == $Sameitem->id && $item->LanguageId != $Sameitem->LanguageId)
                                        <?php
                                            array_push($jsonItem, $Sameitem);
                                        ?>
                                    @endif
                                @endforeach
                                <?php
                                    $jsonItem =json_encode($jsonItem)
                                ?>
                                <button type="button" data-toggle="modal" data-target="#myModal" onclick="assignValTomodel('{{$jsonItem}}', '{{$item->id}}', '{{$allMenuIdjs}}', '{{$allMenutitlejs}}')" class="btn btn-info">Details</button>
                            </td>
                            <form class="from-vertical" action="{{route('menuitemdelete',$item->id)}}" method="post">
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
                                        <form class="from-vertical" id="modalForm" action="{{$Data['globalVariable']['shortUrl']}}/menuitem/update/" method="post">
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
                                                                <label for="email_address" class="col-md-4 col-form-label text-md-right">parent</label>
                                                                <div class="from-conrol">
                                                                    <select id="parent" class="custom-select" name="parent">
                                                                        @foreach($allMenuId as $elem)
                                                                            <option id="opt{{$elem}}" value="{{$elem}}"></option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="user_name" class="col-md-4 col-form-label text-md-right">navOrder</label>
                                                                <div class="col-md-6">
                                                                    <input type="text" name="navOrder" id="navOrder" value="" class="from-conrol">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="present_address" class="col-md-4 col-form-label text-md-right">visible</label>
                                                                <div class="col-md-6">
                                                                    <label class="switch">
                                                                    <input type="checkbox" value=""  id="checboxvisible"  onclick="visiblefunction({{$jsonItem}})" >
                                                                    <span class="slider round"></span>
                                                                    </label>
                                                                    <input type="hidden" name="visible" id="visible" value="0" class="from-conrol">
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





    <!-- Modal -->
    <div class="modal fade mini offset-4" id="myModalOrder" role="dialog">
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
                                <ol class='example'>
                                    <li>
                                        <ul data-id="1" id="sublist">
                                            <li data-id="f">1q</li>
                                            <li data-id="s">2qs</li>
                                            <li data-id="t">3qsw</li>
                                        </ul>
                                    </li>
                                    <li data-id="2">second</li>
                                    <li data-id="3">Third</li>
                                </ol>
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
@section ('scripts')
    <script src="https://johnny.github.io/jquery-sortable/js/jquery-sortable.js"></script>
    <script>
        var group;
        var sublist;
        $(function  () {
            group = $("ol.example").sortable();
            sublist = $('#sublist').sortable();
            var data = group.sortable("serialize").get();
            console.log(data);
        });

        $('button').click(function (){
            var data = group.sortable("serialize").get();
            console.log(JSON.stringify(data));
        });

    </script>
    @endsection
