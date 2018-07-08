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
    @include('indexnavbar')

    <div class="showcase">
      <div class="container">
        <div class = "box">
      <h2>Job Recommender</h2>
      <p class="lead">Get recommended relevant jobs with only a few clicks!
      </p>
    </div>
      <a href="log" class="btn btn-primary" style="visibility: hidden;"> Log Journey </a>
      </div>
    </div>

    <div class="section-a">
      <div class="container">
       <div class="row">

       <div class="col-md-4">
       <i id = "upload" class="fa fa-upload" ></i>
       <h3>Upload your CV And Cover Letter </h3>
       </div>

       <div class="col-md-4">
        <i id="spinner" class="fa fa-clock-o"></i>
       <h3>Wait for a job recommendation</h3>
       </div>

       <div class="col-md-4">
        <i id = "briefcase" class="fa fa-briefcase"></i>
       <h3>Start working!</h3>
       </div>
       </div>
       </div>
       </div>


      <div class="section-b">
      <div class="container">
       <div class="row">

       <div class="col-md-6">
     <p> Welcome to JobRecommendation. Find your recommended job in a simple 3 step process!. Login to your acount, enter the job role and location and then navigate to your recomendation page! The process works by comparing calculating a match score against your CV against 1000's of job descriptions for that specific job role. The top 4 match scores are then used to recommend you the right job! <br><br>       No information will be shared/given. All data recieved will be anonoymised and user data will be stripped using a special algorithm. 
 </p>
       </div>

          <div class="col-md-6"><img src="img/computer.jpg"></div>
      </div>
   </div>
</div>

<div class="section-d">
    <div class="container">
       <div class="row">
        <div class="col-md-8 col-md-offset-2">


       </div>
      </div>
    </div>
</div>

<footer style="position: absolute;     height: 2em; min-width: 100%; bottom: 0;  overflow: hidden;
 ">

    <ul class="nav navbar-nav navbar-right">
            <li><a href="http://facebook.com"> <i class="fa fa-facebook"></i></a>
            </li>
          

          </ul>
    </div>
</footer>


  </body>

</html>
