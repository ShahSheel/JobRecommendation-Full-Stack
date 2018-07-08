
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Applier | Contact</title>
    <link rel="stylesheet" href="css/app.css">
  </head>

  <body>

@include('navbar')
<div id="wrap">
    <div class="title-bar">
      <div class="container">
      <h1>Contact us</h1>
      </div>
    </div>


 <div class="main">
  <div class="container">
    <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
      <div class="panel-heading">
      <h4 class="panel-title"> Contact Us </h4>
      </div>

      <ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

@if(Session::has('message'))
    <div class="alert alert-info">
      {{Session::get('message')}}
    </div>
@endif

      <div class="panel-body">
        {!! Form::open(array('route' => 'contact_store', 'class' => 'form')) !!}
          <div class="form-group">
          {!! Form::label('Your Name') !!}
          @guest
           {!! Form::text('name', null, array('required', 'class'=>'form-control','placeholder'=>'Your name')) !!}
          @else
             {!! Form::text('name',  Auth::user()->name  , array('required', 'class'=>'form-control','placeholder'=>'Your name')) !!}
          @endguest
          </div>
          <div class="form-group">
           {!! Form::label('Your E-mail Address') !!}
           @guest
          {!! Form::text('email', null,  array('required',  'class'=>'form-control', 'placeholder'=>'Your e-mail address')) !!}
             @else
         {!! Form::text('email', Auth::user()->email,  array('required',  'class'=>'form-control', 'placeholder'=>'Your e-mail address')) !!}

          @endguest
          </div>
          <div class="form-group">
          {!! Form::label('Subject') !!}
           {!! Form::text('subject', null, array('required', 'class'=>'form-control','placeholder'=>'Subject Header')) !!}
          </div>

          <div class="form-group">
          {!! Form::label('Your Message') !!}
          {!! Form::textarea('message', null,  array('required', 'class'=>'form-control', 'placeholder'=>'Your message', 'style' => 'resize: none;')) !!}
          </div>
          <div class="form-group">
        {!! Form::submit('Contact Us!',  array('class'=>'btn btn-default')) !!}
         </div>
          {!! Form::close() !!}
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
