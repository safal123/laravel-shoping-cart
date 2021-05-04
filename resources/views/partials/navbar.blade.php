<nav class="navbar navbar-expand-md navbar-light shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      Shop
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a href="{{ route('products.index')}}" class="nav-link">All Products</a>
        </li>
        <!-- <li class="nav-item">
          <a href="{{ route('react') }}" class="nav-link">
            React
          </a>
        </li> -->
        <li>
          <div class="dropdown">
            <button class="btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Categories
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              @foreach($categories as $category)
              <a class="dropdown-item" href="#">{{ $category->name }}</a>
              @endforeach
            </div>
          </div>
        </li>
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        <li class="nav-item">

          <a href="{{ route('cart.view') }}" class="nav-link">
            <i class="fa fa-shopping-cart"></i>
            Cart
            <span class='badge badge-warning' id='lblCartCount'> {{Cart::content()->count()}} </span>
          </a>
        </li>
        @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">
            <i class="fa fa-user"></i>
            {{ __('Login') }}
          </a>
        </li>
        @if (Route::has('register'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">
            <i class="fa fa-sign-in"></i>
            {{ __('Register') }}
          </a>
        </li>
        @endif
        @else
        <li class="nav-item">
          @if(auth()->user()->email == 'pokharelsafal66@gmail.com')
          <a class="nav-link" href="{{ route('admin.home') }}">Admin Panel</a>
          @endif
        </li>
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }} <span class="caret"></span>
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
            <!-- For testing only. Later on we use middleware -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>