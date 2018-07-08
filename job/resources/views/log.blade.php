
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Applier | Log</title>
    <link rel="stylesheet" href="css/app.css">
  </head>

  <body>

@include('navbar')


    <div class="title-bar">
      <div class="container">
      <h1>Logs</h1>
      </div>
    </div>


 <div class="main">
  <div class="container">
    <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
      <div class="panel-heading">
      <h4 class="panel-title"> Who we are </h4>
      </div>
      <div class="panel-body">
      <p> 
      
      <ul> 
       <li>  Monday 18th to 23rd dec Pushed updates from localhost to server. Website is now using laravel. Users are able to register, login and logout. 

        <ul> 
          <li>
       To do:

        - Stop users accessing certain pages if they are not logged 

      </li>
      <li> 
         When users upload a CV in a PDF format, it should be read by a python script and converted to text.
      </li>
    </ul>

      </li>
    </ul>

    <ul> 
       <li>  Examination period - 3rd January to 11th January. Users can now upload a CV which gets converted into text.

        <ul> 
          <li>
       To do:

        - Link query results with API

      </li>
      <li> 
         When users upload a CV in a PDF format, it should be read by a python script and converted to text.
         Fixed issues regarding path envionments and permissions (had to give permissions to IUSR to access python directory), stupid windows 8.1. Wish i was running this on linux. 
      </li>
    </ul>
    </li>
  </ul>

      <ul> 
       <li> 23rd to 29th jan

        <ul> 
          <li>
       To do:

        - Link query results with API

      </li>
      <li> 
        ADJUSTMENT: 
        Keywords is now an additional optional requirement
      </li>
    </ul>
  </li>
</ul>


     <ul> 
       <li> 7th  to 17th fed

        <ul> 
          <li>
       users input data is now sent to the API and saved into a database. 

      </li>
      <li> 
      
      </li>
    </ul>



      </li>
    </ul>

    <ul> 
       <li> 17th  to 20thth fed

        <ul> 
          <li>
      Database is done yay! Now i have to create some sort of VPN in python to i can get the redirected URLS :/ 

      </li>
      <li> 
      
      </li>
    </ul>



      </li>
    </ul>



      </p>

    </div>

    </div>
    </div>
    </div>
    </div>
    </div>



@include('footer')

  </body>
</html>
