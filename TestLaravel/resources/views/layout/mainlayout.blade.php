<!DOCTYPE html>
<html lang="en">
  <head>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    @include('layout.partials.head')
  </head>
  @if(!Route::is(['error-404','error-500']))
<body>
 @endif 
@if(Route::is(['error-404','error-500']))
<body class="error-page">
@endif 
@if(Route::is(['forgetpassword','resetpassword','signin','signup']))
<body class="account-page">
@endif 
  <!-- Main Wrapper -->
<div class="main-wrapper">
  @if(!Route::is(['error-404','error-500','forgetpassword','resetpassword','login','signin','signup']))
    @include('layout.partials.header')
  @endif 
  @if(!Route::is(['error-404','error-500','forgetpassword','pos','resetpassword','login','signin','signup']))
    @include('layout.partials.sidebar')
  @endif 
    @yield('content')
</div>		
<!-- /Main Wrapper -->
    @yield('script')
  </body>
</html>