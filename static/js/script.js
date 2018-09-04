

// Store some cool variables or w/e
var addressBase = "";



// Start jquery load code
$(function() {
	// The main meaty function of the day
	$(window).on('hashchange', function(){
        // On every hash change the render function is called with the new hash.
        // This is how the navigation of our app happens.
        render(decodeURI(window.location.hash));
    });


	function resetData() {
		// Reset w/e we'll be using in the app.
	}



	function render(url) {
        // This function decides what type of page to show
        // depending on the current url hash value.
		console.log(url);

		// Get the keyword from the url.
        var hashBase = url.split('/')[0];

        // Hide whatever page is currently shown.
        $('.main-content .page').removeClass('visible');	// I'll probably have to change this

		// This is a map to hold our transition functions
		var map = {
			// The Homepage.
            '': function() {
				// Reset any data that we might need
				resetData();

				// Ah, this is where we'll have to do an ajax call, I guess
				getData("/api/project/read.php", renderProjectsPage);

                // renderProjectsPage(data);
            },

			// Repositories for project page
            '#repositories': function() {

				// This is where we'd probably have to pass the project ID into the has as a key-value pair

				// Then eventually load the data and swap the views.
            },

		};

		// Then we have to execute the stuff
		// Execute the needed function depending on the url keyword (stored in temp).
        if(map[hashBase]){
            map[hashBase]();
        }
        // If the keyword isn't listed in the above - render the error page.
        else {
            renderErrorPage();
        }
    }


	function renderProjectsPage(data) {
		console.log(data);
		alert("I think I got the data!");
	}





	function renderErrorPage(){
        // Shows the error page.
		alert("You broke something you dummy!");
    }





});





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
