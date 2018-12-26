

// Store some cool variables or w/e
var addressBase = "";
var homepage = "#projects";
var fadeSpeed = 200;
var activeView = homepage;
var currentURL = homepage;
var breadcrumbComponents = {
	"#projects": 1,
	"#": 1,
	"#repos":2,
	"#repositories":2,
	"#code":3,
	"#file":3,
	"#files":3
};
var projects;
var repositories;

var ta_id = 1;	// Temporary, until we get CAS set up.



// Start jquery load code
$(function() {
	if (!isHomepage(decodeURI(window.location.hash).split('/')[0])) {	// Ghetto check for if we're at the homepage
		$("#projects").hide();
	}
	$("#repositories").hide();

	// The main meaty function of the day
	$(window).on('hashchange', function() {
        // On every hash change the render function is called with the new hash.
        // This is how the navigation of our app happens.
		var newURL = decodeURI(window.location.hash);

		if (newURL == '' || newURL == '#') {
			newURL = homepage;
		}

		if (currentURL == newURL) {
			return;	// We don't want to do unnecessary work!!
		}

		// Otherwise, store the state, and render the page
		currentURL = newURL;
        render(currentURL);
    });

	// Load projects page by default
	// getData("/api/project/read.php", renderProjectsPage);
	// breadcrumb("#");

	// Set up some click listeners or something?
	wireModals();

	render(decodeURI(window.location.hash));

});

function resetData() {
	// Reset w/e we'll be using in the app.
}

function render(url) {
	// This function decides what type of page to show
	// depending on the current url hash value.
	console.log(url);
	currentURL = window.location.hash;

	// Get the keyword from the url.
	var hashBase = url.split('/')[0];

	// Hide whatever page is currently shown.
	$('.main-content .page').removeClass('visible');	// I'll probably have to change this

	// This is a map to hold our transition functions
	var map = {
		// The Homepage.
		'': function() {
			window.location.href = homepage;
		},

		'#': function() {
			window.location.href = homepage;
		},

		'#projects': function() {
			// Reset any data that we might need
			resetData();

			// Ah, this is where we'll have to do an ajax call, I guess
			getData("/api/project/read.php", renderProjectsPage);
		},

		// Repositories for project page
		'#repositories': function() {
			project_id = url.split('/')[1];

			if (!project_id) {
				alert("Invalid Project ID!");
				window.location.href = homepage;
			} else {
				getData('/api/repository/read_by_project.php?project_id=' + project_id, renderReposPage);
			}

			// http://localhost:8000/api/repository/read_by_project.php?project_id=2



			// This is where we'd probably have to pass the project ID into the has as a key-value pair
		},

	};

	// Then we have to execute the stuff
	// Execute the needed function depending on the url keyword (stored in temp).
	if(map[hashBase]){
		map[hashBase]();
		toggleView(hashBase);
		breadcrumb(hashBase);
	}
	// If the keyword isn't listed in the above - render the error page.
	else {
		renderErrorPage();
	}
}

function wireModals() {
	/* Projects */
	wireProjectModals();

	/* Repositories */
	wireRepositoryModals();

	// General, for all modals
	$(".modal-close").click(closeModal);
}

function modalSuccess(data) {
	console.log(data);
	closeModal();
	reloadCurrentPage();
}

function modalError(operation, objectType) {
	return function(data) {
		console.log(data);
		alert("Failed to " + operation + " " + objectType + "!");
		closeModal();
	}
}

// Unfortunately all this stuff tends to have duplicated code...
// I'll find a way to fix it though, definitely
function wireProjectModals() {
	// Add
	$("#add-project").click(function() {
		$("#modal-add-project").addClass("active");
		validateRequiredFields("add", "project");
	});

	$("#project-name").on('input', function() {
		// $("#submit-add-project").prop("disabled", $("#project-name").val());
		validateRequiredFields("add", "project");
	});

	$("#submit-add-project").click(function() {
		// Build our object
		var data = {
			id: uuid(),
			name: $("#project-name").val(),
			description: $("#project-description").val(),
			submission_date: getTime(),
		};

		console.log(data);

		postData(data, "/api/project/create.php", modalSuccess, modalError("add", "project"));
	});
}


function wireRepositoryModals() {
	// Allow the button to display the modal
	$("#add-repository").click(function() {
		console.log("Clicked add repo!!");
		$("#modal-add-repository").addClass("active");
		validateRequiredFields("add", "repository");
	});

	var validationHelper = function() {
		validateRequiredFields("add", "repository");
	}
	$("#repository-link").on('input', validationHelper);


	$("#submit-add-repository").click(function() {

		var project_id = parseInt(decodeURI(window.location.hash).split('/')[1]);

		// Build our object
		var data = {
			id: uuid(),
			link: $("#repository-link").val(),
			submission_date: getTime(),
			ta_id: ta_id,
			project_id: project_id,	// This is an assumption lol
			active: 1
		};

		console.log(data);

		// Define our callback methods
		var success = function(data) {
			console.log(data);
			closeModal();
			reloadCurrentPage();
		};

		var error = function(data) {
			console.log(data);
			alert("Failed to add repository!");
			closeModal();
		};

		postData(data, "/api/repository/create.php", modalSuccess, modalError("add", "repository"));
	});

}


function closeModal() {
	if (true || confirm("Close without submitting?")) {
		$(".modal").removeClass("active");
		$(".modal").find(".form-input").val("");	// Clear what's stored inside?
	}
}

function validateRequiredFields(action, modalName) {
	console.log("Validating Fields for Modal: " + modalName + " (" + action + ")");
	var submitButtonID = "#submit-" + action + "-" + modalName;
	var modalID = "#modal-" + action + "-" + modalName;

	var fieldsAreValid = true;

	// Loop over the children
	$(modalID).find(".required").each(function(i, child) {
		fieldsAreValid = fieldsAreValid && !$(this).val();	// Make sure actual text is entered
	});

	// Update our button's enabled/disabled prop
	$(submitButtonID).prop("disabled", fieldsAreValid);
}

function uuid() {
	return Math.floor(Math.random() * 0x100000);
}

function getTime() {
	return new Date().getTime() / 1000;
}


function isHomepage(url) {
	return (url == homepage || url == '' || url == "#");
}

function breadcrumb(pageRoot) {
	var breadIndex = breadcrumbComponents[pageRoot] || 1;

	var i
	for (i = 1; i < 4; i++) {
		if (i <= breadIndex) {
			$("#bread" + i).removeClass("invisible");
			$("#bread" + i).addClass("visible");
		} else {
			$("#bread" + i).removeClass("visible");
			$("#bread" + i).addClass("invisible");
		}
	}
};



function reloadCurrentPage() {
	console.log("Data is out of date, reloading current page");
	render(decodeURI(window.location.hash));
}

function renderReposPage(data) {
	console.log(data);
	repositories = data.records;

	$("#repos-body").empty();

	// Read in the data
	$.each(repositories, function(index, repo) {
		var repo_submission_date = new Date(repo.submission_date * 1000);
		var repo_id = repo.id;
		var repo_url = repo.link;
		var repo_split = repo_url.split('/');
		var repo_description = repo_split[3] + ": " + repo_split[4];

		if (!repo.active) {
			return true;
		}

		// Otherwise, populate the html
		$("#repos-body").append("" +
		"<div class='columns project'>" +
			"<div class='column col-10 col-mx-auto'>" +
				"<div class='tile tile-centered'>" +
					"<div class='tile-icon'>" +
						"<div class=''>" +
							"<button class='btn btn-action' onclick='window.location.href=\"" + repo_url + "\"'><i class='icon icon-share'></i></button>" +
						"</div>" +
					"</div>" +
					"<div class='tile-content'>" +
						"<div class='tile-title'><a href='#projects'>" + repo_description + "</a></div>" +
						"<div class='tile-subtitle text-gray'>" + repo_submission_date + "</div>" +
					"</div>" +
					"<div class='tile-action'>" +
						"<button class='btn btn-link'>" +
						"<button class='btn btn-edit btn-primary' style='margin-right: 0.2rem !important;' onclick='showEditModal()'>Edit</button>" +
						"<button class='btn btn-secondary btn-error' onclick='removeObject(" + repo_id + ", \"repository\")'>Remove</button>" +
						"</button>" +
					"</div>" +
				"</div>" +
			"</div>" +
		"</div>"
		);
	});
}


function renderProjectsPage(data) {
	console.log(data);
	projects = data.records;

	$("#projects-body").empty();

	$.each(projects, function(index, project) {
		// Create some datapoints
		var project_submission_date = new Date(project.submission_date * 1000);
		var project_repo = project.link || "#err";
		var project_name = project.name;
		var project_detail = "#repositories/" + project.id;
		var project_description = project.description || "No description available";
		var project_id = project.id;
		var edit_action = "";
		var remove_action = "";

		// Fill 'er up
		$("#projects-body").append("" +
			"<div class='columns project'>" +
				"<div class='column col-10 col-mx-auto'>" +
					"<div class='tile'>" +
						"<div class='tile-icon'>" +
							"<div class=''>" +
								"<button class='btn btn-action' onclick='window.location.href=" + project_repo + "'><i class='icon icon-share'></i></button>" +
							"</div>" +
						"</div>" +
						"<div class='tile-content'>" +
							"<h4 class='tile-title'><a href='" + project_detail + "'>" + project_name + "</a></h4>" +
							"<hr>" +
							"<p class='tile-subtitle'>" + project_description + "</p>" +
						"</div>" +
						"<div class='tile-action'>" +
							"<button class='btn btn-edit btn-primary' style='margin-right: 0.2rem !important;' onclick='showEditModal()'>Edit</button>" +
							"<button class='btn btn-secondary btn-error' onclick='removeObject(" + project_id + ", \"project\")'>Remove</button>" +
						"</div>" +
					"</div>" +
				"</div>" +
			"</div>");

			// onclick='window.location.href=" + project_repo + "'
			// onclick='showEditModal()'
			// onclick='showRemoveModal()'

	});

}




function renderErrorPage(){
	// Shows the error page.
	alert("You broke something you dummy!");
}


function showEditModal() {
	console.log("Modals will be here eventually!");
}

function removeObject(id, objectType) {
	// I guess that we can just look at the current url to see what api to call
	if (confirm("Are you sure you want to remove the " + objectType + "?")) {
		// We need to remove the project!
		data = {
			id: id
		};

		console.log(data);

		// Define our callback methods
		var success = function(data) {
			console.log(data);
			reloadCurrentPage();
		};

		var error = function(data) {
			console.log(data);
			alert("Failed to remove " + objectType + "!");
		};

		postData(data, "/api/" + objectType + "/delete.php", success, error);

	}
}


function toggleView(input) {
	if (!input) return;

	if(activeView != input)
	{
		$(activeView).fadeOut(fadeSpeed, function()
		{
			$(input).fadeIn(fadeSpeed);
			activeView = input;
		});
	}
}





function getData(handle, callBackSuccess) {
	getData(handle, callBackSuccess, "");	// Just reflect on our other implementation
}


function getData(handle, callBackSuccess, userName) {
	var url = window.location.origin + addressBase + handle;

	console.log("Inside of get function!!");
	console.log(url);

	// Do the get call
	$.getJSON(url, function(data, success, xhr){
		if (success == "success") {
			callBackSuccess(data);	// Pass the data to the success funtion
		} else {					// Otherwise, log the error or something
			console.log("Data Retrieval Error!");
			console.log(success);
			console.log(xhr);	// This will probs be removed in prod
		}
	});
}

function postData(data, handle) {

	var success =  function (data) {
		console.log("Post complete");
		console.log(data);
		// updateUI(data);
	};

	var error = function(data) {
		console.log(data);
	};
	postData(data, handle, success, error);
}

function postData(data, handle, callBackSuccess, callBackError) {

	console.log(window.location.origin + addressBase + handle);
    $.ajax({
        url: window.location.origin + addressBase + handle,
        type: 'post',
        dataType: 'json',
        success: callBackSuccess,
		error: callBackError,
        data: data
    });
}
