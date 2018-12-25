

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


	function resetData() {
		// Reset w/e we'll be using in the app.
	}

	// Load projects page by default
	// getData("/api/project/read.php", renderProjectsPage);
	// breadcrumb("#");



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

				// Then eventually load the data and swap the views.
				// alert("You're looking for the repos for project #" + url.split('/')[1]);
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




	// Set up some click listeners or something?
	$("#add-project").click(function() {
		alert("Time to add a new project, eh?");
	});

	render(decodeURI(window.location.hash));
	// if (window.location.hash != homepage) {
	// 	window.location.hash = homepage;
	// }

});


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


function renderReposPage(data) {
	console.log(data);

	$("#repos-body").empty();

	// Read in the data
	$.each(data.records, function(index, repo) {
		var repo_submission_date = new Date(repo.submission_date * 1000);
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
						"<button class='btn btn-secondary btn-error' onclick='showRemoveModal()'>Remove</button>" +
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

	$("#projects-body").empty();

	$.each(data.records, function(index, project) {
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
							"<button class='btn btn-secondary btn-error' onclick='removeModal(" + project_id + ")'>Remove</button>" +
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

function showRemoveModal() {
	console.log("Modals will be here eventually!");
}

function removeModal(id) {
	// I guess that we can just look at the current url to see what api to call
	console.log(id);
}

function addProjectModal() {

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
