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
					<button id="add-repository" class="btn btn-accent"><i class="icon icon-plus"></i></button>
				</div>
			</div>
			<div id="repos-body">

			</div>

			<br>
			<br>
		</div>

		<!-- Add project Modal -->
		<div class="modal modal-sm" id="modal-add-project">
			<p class="modal-overlay modal-close" style="cursor: pointer;" aria-label="Close"></p>
			<div class="modal-container">
				<div class="modal-header" style="padding-bottom: 0rem;">
					<p class="btn btn-clear float-right modal-close" style="cursor: pointer;" aria-label="Close" ></p>
					<div class="modal-title h5">Add Project</div>
					<hr>
				</div>
				<div class="modal-body">
					<div class="content">
						<!-- content here -->
						<div class="form-group">
							<label class="form-label" for="project-name">Name</label>
							<input class="form-input required" id="project-name" type="text" placeholder="Name">
						</div>
						<div class="form-group">
							<label class="form-label" for="project-description">Description (optional)</label>
							<textarea class="form-input" id="project-description" type="text" placeholder="Description"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" id="submit-add-project">Submit</button>
					<a class="btn btn-link modal-close" style="cursor: pointer;" aria-label="Close">Close</a>
				</div>
			</div>
		</div>

		<!-- Edit project modal -->
		<div class="modal modal-sm" id="modal-edit-project">
			<p class="modal-overlay modal-close" style="cursor: pointer;" aria-label="Close"></p>
			<div class="modal-container">
				<div class="modal-header" style="padding-bottom: 0rem;">
					<p class="btn btn-clear float-right modal-close" style="cursor: pointer;" aria-label="Close" ></p>
					<div class="modal-title h5">Edit Project</div>
					<hr>
				</div>
				<div class="modal-body">
					<div class="content">
						<!-- content here -->
						<div class="form-group">
							<label class="form-label" for="project-name">Name</label>
							<input class="form-input required" id="project-name-edit" type="text" placeholder="Name">
						</div>
						<div class="form-group">
							<label class="form-label" for="project-description">Description (optional)</label>
							<textarea class="form-input" id="project-description-edit" type="text" placeholder="Description"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" id="submit-edit-project">Update</button>
					<a class="btn btn-link modal-close" style="cursor: pointer;" aria-label="Close">Close</a>
				</div>
			</div>
		</div>


		<!-- Add Repository Modal -->
		<div class="modal modal-sm" id="modal-add-repository">
			<p class="modal-overlay modal-close" style="cursor: pointer;" aria-label="Close"></p>
			<div class="modal-container">
				<div class="modal-header" style="padding-bottom: 0rem;">
					<p class="btn btn-clear float-right modal-close" style="cursor: pointer;" aria-label="Close" ></p>
					<div class="modal-title h5">Add Repository</div>
					<hr>
				</div>
				<div class="modal-body">
					<div class="content">
						<!-- content here -->
						<div class="form-group">
							<label class="form-label" for="repository-link">Link</label>
							<input class="form-input required" id="repository-link" type="text" placeholder="Description"></input>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" id="submit-add-repository">Submit</button>
					<a class="btn btn-link modal-close" style="cursor: pointer;" aria-label="Close">Close</a>
				</div>
			</div>
		</div>




		<!-- <div class="" id="temp-body">
			<p id="test-click">Hey there, space cowboy!</p>
			<a href="#">Click me if you dare!</a>
			<br>
			<a href="#broke">This should break the page</a>
		</div> -->







		<!-- Cool scripts for the site to get its groove on -->
		<script src="static/js/jquery-3.3.1.min.js"></script>
		<script src="static/js/jquery.easing.js"></script>
		<script src="static/js/jqueryFileTree.js"></script>
		<script src="static/js/materialize.min.js"></script>
		<script src="static/js/script.js"></script>
	</body>
</html>
