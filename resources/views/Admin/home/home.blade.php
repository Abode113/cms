<!DOCTYPE html>
<html>
<header>
    <title>
        Admin - @yield('title') | TheBabies
    </title>
  @include('Admin.partials.head')
</header>
<body>
<nav class="navbar navbar-default navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-inner navbar-nav mr-auto">
            <div class="row">
                @if($Data['role'])
                    @foreach($Data['role'][1] as $elem)
                        @if($elem == 'admin_role_name' || $elem == 'dataentry_role_name')
                            <li>
                                <a class="btn btn-primary" href="{{$Data['globalVariable']['Url']}}/home/1">FrontEnd</a>
                            </li>
                            @break
                        @endif
                    @endforeach
                @endif
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
    @endguest

</nav>
<div class="jumbotron">
    <h1 class="display-3">Controle Panel</h1>
    <p class="lead">Welcome to your controle panel.</p>
    <hr class="my-4">
    <p>content management system</p>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="{{$Data['globalVariable']['adminUrl']}}/home/menuitem" role="button">Menu items</a>
        <a class="btn btn-primary btn-lg" href="{{$Data['globalVariable']['adminUrl']}}/home/item" role="button">items</a>
        <a class="btn btn-primary btn-lg" href="{{$Data['globalVariable']['adminUrl']}}/home/category" role="button">Categories</a>
        <a class="btn btn-primary btn-lg" href="{{$Data['globalVariable']['adminUrl']}}/home/Language" role="button">Languagee</a>
        <a class="btn btn-primary btn-lg" href="{{$Data['globalVariable']['adminUrl']}}/home/Dictionary" role="button">Dictionary</a>
        <a class="btn btn-primary btn-lg" href="{{$Data['globalVariable']['adminUrl']}}/home/Attribute" role="button">cateory custom attribute</a>
        <a class="btn btn-primary btn-lg" href="{{$Data['globalVariable']['adminUrl']}}/home/itemCustomAttribute" role="button">item custom attribute</a>
        @if($Data['role'])
            @foreach($Data['role'][1] as $elem)
                @if($elem == 'admin_role_name')
                    <a class="btn btn-primary btn-lg" href="{{$Data['globalVariable']['adminUrl']}}/home/Role" role="button">Role</a>
                    <a class="btn btn-primary btn-lg" href="{{$Data['globalVariable']['adminUrl']}}/home/User" role="button">User</a>
                    <a class="btn btn-primary btn-lg" href="{{$Data['globalVariable']['adminUrl']}}/home/Permission" role="button">Permission</a>
                    @break
                @endif
            @endforeach
        @endif
    </p>
</div>
@yield('Body')

@include('Admin.partials.foot')
</body>
</html>
