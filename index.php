<?php

$path = dirname( __FILE__ );
$slash = '/'; strpos( $path, $slash ) ? '' : $slash = '\\';
define( 'BASE_DIR', $path . $slash );
if(file_exists(BASE_DIR . $slash . 'update.php')){
  require('/update.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <link rel="icon" href="">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
  <title>Alpha Project | Regression Testing | An Implementation</title>

  <!-- Bootstrap core CSS -->
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/bootstrap-theme.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
  <script src="/js/jquery.min.js"></script>
  <script src="/js/d3.v3.min.js"></script>
  <script type='text/javascript' src="/js/jquery-ui.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/css/jquery-ui.css">
</head>
<?php session_start();if(isset($_SESSION['user'])){ ?>
<body onload="javascript: get('<?php echo $_SESSION['user'];?>');">
<?php }else{echo "<body>";}?>
  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Alpha Project</a>
      </div>
      <?php if(isset($_SESSION['user'])){ ?>
      <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right right-margin">
              <li><a href="/error.php">Logout</a></li>
          </ul>
      </div>
      <?php } ?>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar">
          <li class="active" id="overview"><a href="#">Overview</a></li>
          <li id="report"><a href="" onclick="reportactive();" data-toggle="modal" data-target="#formreport">Reports</a></li>
          <li id="analytic"><a href="#">Analytics</a></li>
          <li id="tables"><a href="#">Tables</a></li>
        </ul>
      </div>
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Dashboard</h1>
        <div class="main-inner">
          <?php
              if(!(isset($_SESSION['user']))){
          ?>
          <form id="login-form" action="javascript: get($('#username').val());">
            <div class="form-group">
              <input class="form-control" type="text" placeholder="Enter Username or Project name" id="username" />
            </div>
            <div class="form-group">
              <input class="btn btn-default hidden" type="submit" value="Submit" />
            </div>
          </form>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="formreport" tabindex="-1" role="dialog" aria-labelledby="reportLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="reportLabel">Select file to generate report</h4>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default formclose" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/docs.min.js"></script>
  <script src="/js/main.js"></script>
</body>
</html>