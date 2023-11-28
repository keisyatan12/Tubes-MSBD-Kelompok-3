<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-grid.css') }}">   
    <script src="https://kit.fontawesome.com/bc3cf86588.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>    
</head>
<body>

    @include('partials.navbar')

 <!-- login -->
  <body style="background-color: #666666;">	
    <div class="limiter">
      <div class="container-login100">
        <div class="wrap-login100">
          <form class="login100-form validate-form">
            <span class="login100-form-title p-b-43" style="font-weight: bolder; color: #ff852d;">
              Masuk ke SIA
            </span>  <br>         
            <div class="wrap-input100 validate-input" data-validate = "" style="height: 60px;">
              <input class="input100" type="text" name=""  >
              <span class="focus-input100"></span>
              <span class="label-input100">NISN/NUPTK</span>
            </div>         
            <div class="wrap-input100 validate-input" data-validate="Password is required" style="height: 60px;">
              <input class="input100" type="password" name="pass">
              <span class="focus-input100"></span>
              <span class="label-input100">Password</span>
            </div>
            <div class="flex-sb-m w-full p-t-3 p-b-32" >
              <div class="contact100-form-checkbox">
                <!-- <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                <label class="label-checkbox100" for="ckb1">
                  Remember me
                </label> -->
              </div>
              <div>
                <a href="/forgot" class="txt1 ">
                  lupa password?
                </a>
              </div><br>
            </div>
            <div class="container-login100-form-btn">
              <button class="login100-form-btn" style="background-color: #f8af7b; font-size: larger;">
                Login
              </button>
      
            </div>
          </form>
          <div class="login100-more" style="background-image: url({{ asset('assets/img/login2.png') }});">
          </div>
        </div>
      </div>
    </div>

    @include('partials.footer_maps')

<script src="https://kit.fontawesome.com/bc3cf86588.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
</body>
</html>