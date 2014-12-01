<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
   </head>
  <body style="background-color:#505050">
  <nav class="navbar navbar-default navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" style="color:#FFCC00" href="index.php">Hostile Work Environment</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="hire.php">Hire</a></li>
            <li><a href="fire.php">Fire</a></li>
           </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
   <div class="container">
     <div class="container" >
      <div class="row">
        <div class="col-lg-2" ></div>
         <div class="col-offset-6 col-sm-8 centered">
            <div class="alert alert-danger" role="alert">SCUESS!!!</div>
            <div class="panel panel-info">
               <div class="panel-heading">
                  <h1 class="panel-title">Fire employee form</h1>
               </div>
               <div class="panel-body">
                  <form class="form-horizontal" role="form"  action="example.php" method="post">
                    <div class="form-group">
                      <label for="cage" class="col-sm-2 control-label">Cage:</label>  
                      <div class="col-sm-8">
                        <select class="form-control" name="cage">
                          <option value="1001">1001</option>
                          <option value="1002">1002</option>
                          <option value="1003">1003</option>
                          <option value="1004">1004</option>
                          <option value="1005">1005</option>
                          <option value="1006">1006</option>
                          <option value="1007">1007</option>
                          <option value="1008">1008</option>
                          <option value="1009">1009</option>
                          <option value="1010">1010</option>
                        </select>
                       </div>
                     </div>
                     <p></p>
                     <div class="col-lg-12 form-group">
                        <button type="submit" class="btn btn-block btn-lg btn-danger">Fire!</button> 
                     </div>
                  </div>
               </form>
            </div>
      </div>
   </div>
   </div>
 </body>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
   <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</html>