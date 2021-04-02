<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Grayscale - Start Bootstrap Theme</title>
        <link rel="icon" type="image/x-icon" href="/favicon.ico" />
        <link rel="stylesheet" href="{{ asset('vendors/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet"/>
        <link rel="stylesheet" href="{{ asset('vendors/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet"/>
        <link href="css/styles.css?{{ md5(time()) }}" rel="stylesheet" />
    </head>
    <body>
        <section class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Attela</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}" tabindex="-1" aria-disabled="true">Login</a>
                  </li>
                </ul>
                <form class="d-flex">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" type="search" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
                        <button class="btn btn-outline-success btn-sm" type="submit"><i class="bi bi-search"></i></button>
                      </div>
                </form>
              </div>
            </div>
          </nav>
        </section>
        <div class="container">
          @yield('content')
      </div>
        <footer class="footer bg-black small text-center text-white-50"><div class="container">Copyright © Your Website 2020</div></footer>
        <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendors/jquery/dist/popper.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    </body>
</html>

