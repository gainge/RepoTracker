<?php
header("Access-Control-Allow-Origin: *");

?>

<!--

Todo:
	-Add repo links to db (?)
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
			<li class='' id='bread1'><a href="#projects">Projects</a></li>
			<li class='invisible' id='bread2'><a href="#">Repos</a></li>
			<li class='invisible' id='bread3'><a href="#">Code</a></li>
		</ul>


		<!-- Projects -->
		<div class="container" id="projects">
			<div class="page-header">
				<div class="">
					<h3>Projects</h3>
				</div>
				<div class="add-btn">
					<button id="add-project" class="btn btn-accent"><i class="icon icon-plus"></i></button>
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



		<!-- Repositories -->
		<div class="container" id="repositories">

			<div class="page-header">
				<div class="">
					<h3>Repositories</h3>
				</div>
				<div class="add-btn">
					<button class="btn btn-accent"><i class="icon icon-plus"></i></button>
				</div>
			</div>
			<div id="repos-body">
				<div class="columns project">
					<div class="column col-10 col-mx-auto">
						<div class="tile tile-centered">
							<div class="tile-icon">
								<div class="">
									<button class="btn btn-action"><i class="icon icon-share"></i></button>
								</div>
							</div>
							<div class="tile-content">
								<div class="tile-title">spectre-docs.pdf</div>
								<div class="tile-subtitle text-gray">14MB · Public · 1 Jan, 2017</div>
							</div>
							<div class="tile-action">
								<button class="btn btn-link">
									<!-- <i class="icon icon-more-vert"></i> -->
									<button class="btn btn-primary">Edit</button>
									<button class="btn btn-error btn-secondary">Remove</button>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<br>
			<br>
		</div>

		<div class="modal modal-sm" id="modal-id">
			<!-- <a href="#close" class="modal-overlay" aria-label="Close"></a> -->
			<div class="modal-container">
				<div class="modal-header">
					<a href="#" class="btn btn-clear float-right" aria-label="Close"></a>
					<div class="modal-title h5">Modal title</div>
				</div>
				<div class="modal-body">
					<div class="content">
						<!-- content here -->
					</div>
				</div>
				<div class="modal-footer">
				</div>
			</div>
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
