<?php
session_start();

require_once "../include/connection.php";
require_once "../include/functions.php";



$dt = new DateTime();
$thisDate = $dt->format('Y-m-d');
$thisYear = $dt->format('Y');

// For Alert-bar
$alert_type = "warning";
$alert_status = "hidden";
$alert_icon = "exclamation-sign";
$alert_content = "A warning!";

if(loggedin()) {
	$user[] = array();
    $user['user_id'] = $_SESSION['user_id'];
	$user['username'] = $_SESSION['username'];
	$user['email'] = $_SESSION['email'];
	$user['name'] = $_SESSION['name'];
	$user['mob_no'] = $_SESSION['mob_no'];
	$user['gender'] = $_SESSION['gender'];
	$user['matric_no'] = $_SESSION['matric_no'];
	$user['department'] = $_SESSION['department'];
	$user['occupation'] = $_SESSION['occupation'];
	$user['downloaded'] = $_SESSION['downloaded'];
	$user['borrowed'] = $_SESSION['borrowed'];
} else {
    header ("Location: ../");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>LMS - Home</title>

  <!-- CSS  -->
  <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
  <link href="assets/css/superhero.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

  <!--  Scripts-->
  <script type="text/javascript" src="assets/js/jquery.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

</head>
<body>

<!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">

        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target="#nvyta">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./"><img src="assets/imgs/book-cover-page.jpg" width="25" height="25" /></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="nvyta">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="./">Home</a></li>
                    <li><a href="catalogue/">Catalogue</a></li>
                    <li><a href="about/">About LMS?</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                	<form class="navbar-form navbar-left" role="search">
						<div class="form-group">
						<input type="text" class="form-control" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
					</form>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- alert bar -->
	<div class="alert alert-<?php echo $alert_type; ?> alert-dismissable text-center alert-bar <?php echo $alert_status; ?>" style="margin-top: -20px;">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times; </button>
	    <span class="glyphicon glyphicon-<?php echo $alert_icon; ?>"> </span>
	    <?php echo $alert_content; ?>
	</div>


    <div class="row">
    	<div class="container-fluid">
    		<div class="col-md-12">

    			<div class="jumbotron text-center">
    				<h2 id="txt">FEEL FREE TO READ & DOWNLOAD SOFT COPY BOOKS FROM OUR LIBRARY!</h2>
    				<nav>
    					<a id="l-txt" class="glyphicon glyphicon-circle-arrow-left text-warning txt-control"></a>
    					<a id="r-txt" class="glyphicon glyphicon-circle-arrow-right text-warning txt-control"></a>
    				</nav>
    				<script type="text/javascript">
    				var text = "";
    				var text1 = "INTRO SENTENCE 1";
    				var text2 = "INTRO SENTENCE 2";
    				var text3 = "INTRO SENTENCE 3";
					var txt = [text1, text2, text3];

    					$("#l-txt").click(function() {
    						text = $("#txt").text();

    						if(text == text1) {
    							$("#txt").text(text3);
    						} else if(text == text2) {
    							$("#txt").text(text1);
    						} else {
    							$("#txt").text(text2);
    						}
    					});
    					$("#r-txt").click(function() {
    						text = $("#txt").text();

    						if(text == text1) {
    							$("#txt").text(text2);
    						} else if(text == text2) {
    							$("#txt").text(text3);
    						} else {
    							$("#txt").text(text1);
    						}
    					});
    				</script>
    			</div>


	    		<!-- main column 1 -->
	    		<div class="col-md-4">
	    			<div class="well">
		    			<h4>Latest Books</h4>
		    			<hr>

		    			<ul class="media-list">
							<li class="media">
							<a class="pull-left" href="#">
							<img class="media-object" src="assets/imgs/book-cover-page.jpg" alt="book 1">
							</a>
							<div class="media-body">
							<h4 class="media-heading">Book 1</h4>
							<p>This is the book description</p>
							</div>
							</li>
						</ul>
	    			</div>
	    		</div>

	    		<!-- main column 2 -->
	    		<div class="col-md-8">
	    			<div class="well">This is well 1</div>
	    		</div>


	    		<div class="clearfix"></div>

		    	<hr>

		    	<div class="footer">
		  			<p>&copy; 2016</p>
		  		</div>

		  	</div>
    	</div>
    </div>

  

  </body>
</html>
