<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Job Applier</title>
  </head>

  <body>

@include('navbar')
<div class="title-bar">
    <div class="container">
    <h1></h1>
    </div>
  </div>



<div class="main">
<div class="container">
  <div class="row">
  <div class="col-md-8 ">
    <div class="panel panel-default">
    <div class="panel-heading">
    <h4 class="panel-title">Login</h4>
    </div>
    <div class="panel-body">
     <form>

        <div class="form-group form-inline">
           <font size="4px">  <i id = "upload" class="fa fa-user-o"></i> </font>
        <input type="Email" class="form-control" placeholder="E-Mail Address" requried>
        </div>
        <div class="form-group form-inline">
        <font size="3px"> <i id = "upload" class="fa fa-key "></i> </font>
        <input type="password" class="form-control" placeholder="Password" required >
        </div>
        <button type="submit" href="/me/apply.html" class="btn btn-default">Login</button>
        </form>
        <br/>
        <a = href="reset"><font color="blue"> Forgot Password? </font> </a>
        <br/>
        <br/>
        <a = href="#""><font color="blue"> Register </font> </a>

  </div>

  </div>

  </div>

      <div class="col-md-4 ">
      <div class="list-group">
      <a href="#" class="list-group-item active">
      Or Login With</a>
      <a href ="#" class="list-group-item"> sd </a>
      <a href ="#" class="list-group-item"> sd </a>
              </div>
              </div>
              </div>
              </div>
              </div>
              </div>
              </div>


  </div>

  </div>

  </div>


  @include('footer')
</body>
</html>
