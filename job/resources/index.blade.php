
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
    <div class="applyCover">
      <div class="container">
        <h1>Your recommended jobs!</h1>
      </div>
    </div>
  </div>
  <div class="main">
      <div class="col-md-4 ">
      <div class="list-group">
      <a href="#" class="list-group-item active">Settings</a>
      <a href ="#" class="list-group-item"> Account Management </a>
      <br/> <br/>
      <a href ="#" class="list-group-item">Delete account</a>
                <div class="col-md-4 ">
       <br>
  

    </div>

      </div>
    </div>

  </div>


<div class="container">
  <div class="row">
    <div class="col-md-8 ">
      <div class="panel panel-default">
        <div class="panel-heading"><h4>Recommended Jobs</h4></div>
        <div class="panel-body">

          {!! Form::open(array('route' => 'recommender_store', 'class' => 'form', 'files' => true)) !!}

             @foreach($job as $key => $data)
              
                <tr>    
                  <div class="title-bar" @if ($key === 0) @endif>
                  <h5><b>#{{$key+1}} Recommendation </b> <p> {{$data->title}} </p> <p> {{$data->location_of_job}} </p> <p> {{$data->salary}} </p>  <u><a href ="{{$data->recommended_job}}"> See here </a></u></h5>
                  </div>
                  <br>            
                </tr>
            @endforeach

            {{ Form::close()}}

          </div>

        </div>
      </div>
    </div>

</div>

    </div>
@include('footer')
</body>
</html>

