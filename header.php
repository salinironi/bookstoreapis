<?php 
require( "config/main_config.php" );
$baselink = BASELINK;
$GLOBALS['baselink'] = $baselink;
?>  		
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Book Store - RESTful APIs</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" href="<?php echo $baselink; ?>css/normalize.css">
         <link rel="stylesheet" href="<?php echo $baselink; ?>css/bootstrap.min.css">

        <link rel="stylesheet" href="<?php echo $baselink; ?>css/main.css">
        <script src="<?php echo $baselink; ?>js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
    

 
 
     <header class="header-outer">
    <header class="container">
     <a href="<?php echo $baselink; ?>" class="logo"><img src="<?php echo $baselink; ?>img/logo.png" alt=""></a>
    
    <nav class="nav-secondary">
    <ul>
        			<li>
    			    			<a href="<?php echo $baselink; ?>">
    			RESTful API's - Documentation</a></li>
                           			<li>
    			    			<a href="<?php echo $baselink; ?>createbook.php">
    			Create A Book</a></li>
                        
                        <li class="first"><a href="<?php echo $baselink; ?>updatebook.php">
    			Update A Book</a></li>
    			    			<li class="last">
    			    			<a href="<?php echo $baselink; ?>deletebook.php">
    			Delete A Book</a></li>
    			    </ul></nav>
<nav class="nav-primary">

    <ul class="nav-one">
    			<li class="first no-bdr"><a href="<?php echo $baselink; ?>retrievebook.php">
    			Retrieve A Book (by ISBN)</a></li>
    			    			<li><a href="<?php echo $baselink; ?>searchbook.php">
    			Search Books</a></li>
    			    			<li><a href="<?php echo $baselink; ?>allbooks.php">
    			All Books</a></li>
    			    			
    			</ul>

<ul class="nav-two">
    			   		<li class="last no-bdr">
    		<a href="<?php echo $baselink; ?>details.php" >More Details
    		</a></li>
    		    		
    		    		<!--<li class="last no-bdr">
    		<a href="<?php echo $baselink; ?>feedback">&nbsp;&nbsp;&nbsp;Feedback
    		</a></li>-->
    		    		
    		 	</ul>

 </nav> </header></header>
