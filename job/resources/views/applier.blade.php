
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

  <body oncontextmenu="return false">
@include('navbar')
  <div class="title-bar">
    <div class="applyCover">
      <div class="container">
        <h1>Start Applying</h1>
      </div>
    </div>
  </div>
  <div class="main">
      <div class="col-md-4 ">
      <div class="list-group">
      <a href="#" class="list-group-item active">Settings</a>
      <a href ="#" class="list-group-item"> Account Management </a>
      <br/> <br/>
      <a href ="#" class="list-group-item" data-toggle="modal" data-target="#myModal"> Delete account</a>
      </div>
    </div>
  </div>


<div class="container">
  <div class="row">
    <div class="col-md-8 ">
      <div class="panel panel-default">
        <div class="panel-heading"><h4>Apply</h4></div>
          <div class="alert alert-info">
            @if(Session::has('message'))
             {{Session::get('message')}}
            @else
            <strong> Hey {{ Auth::user()->name }}!</strong> Currently supports PDF uploads only
            @endif
        </div>
        <div class="panel-body">


          {!! Form::open(array('route' => 'recommender_store', 'class' => 'form', 'files' => true)) !!}


            <div class="form-group">
             {!! Form::label('Upload CV') !!}
             {!! Form::file('cvupload', null, array('required', 'class' => 'form-control', 'type' => 'file')) !!}
            <script type="text/javascript">
                function SetAccept() {
                  document.getElementById("cvupload").accept = ".pdf";
                }
               
            </script>
            </div>
            <div class="form-group">
             {!! Form::label('Job Title') !!}
              {!! Form::text('jobrole', "", array('required', 'class' => 'form-control','placeholder'=>'What job role are you looking for')) !!}

            </div>
              <div class="form-group">
              {!! Form::label('Where') !!}
              {!! Form::text('location', "", array('required', 'class'=>'form-control','placeholder'=>'Where do you want to work')) !!}

              </div>
              {{ Form::submit('Submit', array('class' => 'btn btn-default')) }}

            {{ Form::close()}}

          </div>

        </div>
      </div>
    </div>
     <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            {!! Form::open(array('route' => 'deleteAccount', 'class' => 'form')) !!}
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Do you really wish to delete your account {{ Auth::user()->name }}? </h4>
        </div>
        <div class="modal-body">
          <p>All data belonging to you will be deleted. Job Searches, Recommendations, CV's.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           {!! Form::submit('Delete Account',  array('class'=>'btn btn-danger')) !!}
        </div>
           {!! Form::close() !!}

      </div>
      
    </div>
  </div>
  </div>
  
@include('footer')

</body>

</html>
