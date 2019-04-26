@extends('welcome')

@section('title')
    @yield('title')
@endsection

@section('metaDescription')
    @yield('metaDescription')
@endsection

<link href="{{ asset('css/enduserHome.css') }}" rel="stylesheet" type="text/css" >


@section('NavBar')
<nav class="navbar navbar-default navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-inner navbar-nav mr-auto">
            <div class="row">
            @foreach($Data['MenuItem'] as $item)
                @if(!empty($item->sons))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                            {{$item->title}}
                        </a>
                        <div class="dropdown-menu">
                            <ul class="nav flex-column">
                                @foreach($item->sons as $elem)
                                    <li class="nav-item">
                                        <a class="dropdown-item" href="{{$Data['globalVariable']['Url']}}/getallcategoriesByParentId/{{$elem->category_id}}/{{Session::get('defaultLanguage')}}">{{$elem->title}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{$Data['globalVariable']['Url']}}/getallcategoriesByParentId/{{$item->category_id}}/{{Session::get('defaultLanguage')}}">{{$item->title}}</a>
                    </li>
                @endif
            @endforeach
                <div class="offset-9 col-md-2">
                    <form id="LangForm" class="from-vertical" action="{{$Data['globalVariable']['shortUrl']}}/Language/setdefaultLanguage" method="post">
                        {{ csrf_field() }}
                    <select name="defaultLanguage" id="mySelect" class="custom-select" onchange="myFunction()">
                        @foreach($Data['globalVariable']['Languages'] as $Lang)
                            @if(Session::get('defaultLanguage') == $Lang->id)
                                <option selected="" value="{{$Lang->id}}">{{$Lang->LanguageName}}</option>
                            @else
                                <option value="{{$Lang->id}}">{{$Lang->LanguageName}}</option>
                            @endif
                        @endforeach
                    </select>
                    </form>
                </div>
            </div>
        </ul>
    </div>
    <?php
    //dd(Auth::user());
    ?>
    @guest
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>

        @if($Data['role'])
            @foreach($Data['role'][1] as $elem)
                @if($elem == 'admin_role_name' || $elem == 'dataentry_role_name')
                    <li>
                        <a class="btn btn-primary" href="{{$Data['globalVariable']['adminUrl']}}/home">Controle Panel</a>
                    </li>
                    @break;
                @endif
            @endforeach;
        @endif
    @endguest

</nav>
<!-- provide the csrf token -->
<script>
    function myFunction() {
        //debugger;
        var x = document.getElementById("mySelect").value;
        console.log('x = ' + x);
        if(isFinite(x)) {
            values = $(location).attr('href');
            if (isFinite(values[values.length - 1])) {
                values = values.split('/');
                values[values.length - 1] = x;
                values = values.join('/');
            } else {
                values = values + '/' + x;
                console.log(values);
            }
        }
        $(location).attr('href', values)
        //location.reload();
    }
</script>

@yield('Body')

@endsection
