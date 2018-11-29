<?php
header("Access-Control-Allow-Origin: *");

?>

<!--

Todo:
	-Add repo links to db
	-Make breadcrumbs dynamic
	-Add modals to all cool buttons on projects page
	-Actually be able to add projects using the cool yellow button

-->

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Repo Tracker</title>
		<!-- Some stuff to make the favicon work I guess -->
		<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
		<link rel="manifest" href="/site.webmanifest">
		<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
		<meta name="msapplication-TileColor" content="#603cba">
		<meta name="theme-color" content="#ffffff">

		<!-- Our actual resources -->
		<link rel="stylesheet" href="static/css/spectre-exp.min.css"/>
		<link rel="stylesheet" href="static/css/spectre-icons.min.css"/>
		<link rel="stylesheet" href="static/css/spectre.min.css"/>
		<link rel="stylesheet" href="static/css/style.css"/>

		<link rel="stylesheet" href="static/css/jqueryFileTree.css">
		<!-- <link rel="stylesheet" href="static/css/materialize.min.css"> -->
	</head>
	<body>

		<div class="container" id="nav">
			<header class="navbar">
				<section class="navbar-section">
					<a href="https://students.cs.byu.edu/~cs240ta/" class="navbar-brand mr-2">CS 240 Home</a>
					<a href="" class="btn btn-link">Docs</a>
				</section>
				<section class="navbar-center">
					<h2 id="site-header">Pulic Code Tracking</h2>
				</section>

				<section class="navbar-section">
					<div class="input-group input-inline">
						<input class="form-input" type="text" placeholder="search">
						<button class="btn btn-primary input-group-btn">Search</button>
					</div>
				</section>
			</header>
		</div>

		<ul class="gib_breadcrumb">
			<li><a href="#">Projects</a></li>
			<li><a href="#">Repos</a></li>
			<li><a href="#">Code</a></li>
		</ul>

		<div class="container" id="project-container">
			<div class="page-header">
				<div class="">
					<h3>Projects</h3>
				</div>
				<div class="" id="add-project">
					<button class="btn btn-accent"><i class="icon icon-plus"></i></button>
				</div>
				<!-- <div class="columns">

				</div> -->
			</div>

			<div id="projects-body">
				<!-- Content pulled from server goes here -->

			</div>


			<br>
			<br>

		</div>




		<div class="" id="temp-body">
			<p id="test-click">Hey there, space cowboy!</p>
			<a href="#">Click me if you dare!</a>
			<br>
			<a href="#broke">This should break the page</a>
		</div>







		<!-- Cool scripts for the site to get its groove on -->
		<script src="static/js/jquery-3.3.1.min.js"></script>
		<script src="static/js/jquery.easing.js"></script>
		<script src="static/js/jqueryFileTree.js"></script>
		<script src="static/js/materialize.min.js"></script>
		<script src="static/js/script.js"></script>
	</body>
</html>
