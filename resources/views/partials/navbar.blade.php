<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container">
      <a class="navbar-brand" href="/">Simple CRUD</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item"></li>
          @auth
          <li class="nav-item">
            <a class="nav-link active" href="customer">Customer</a>
          </li>
          @if (auth()->user()->level == "admin")
            <li class="nav-item">
              <a class="nav-link active" href="service/admin">Service</a>
            </li>
            @elseif (auth()->user()->level == "user")
            <li class="nav-item">
              <a class="nav-link active" href="service/user">Service</a>
            </li>
            @endif
        </ul>
        </div>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Welcome back, {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><span class="dropdown-item-text">
                @if (auth()->user()->level == "superadmin")
                    Super Admin
                @elseif(auth()->user()->level == "admin")
                    Admin
                @elseif(auth()->user()->level == "user")
                    User
                @endif  
              </span></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                </form>
              </li>
            </ul>
          </li>
        @else
      </ul>
    </div>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item">
        <a class="nav-link active" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Login</a>
      </li>
    </ul>
    @endauth
  </nav>