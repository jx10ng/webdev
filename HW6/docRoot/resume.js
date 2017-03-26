document.addEventListener('DOMContentLoaded', function() { 
	// Execute try.
	try{  
		// Page object containing basic information about each page.
		// Used to store page data once loaded with Ajax.
		 var pages = {
			summary: {title: "Summary", url: "pages/summary.html", content: ""},
			contact: {title: "Contact", url: "pages/contact.html", content: ""},
			references: {title: "References", url: "pages/references.html", content: ""}
		}

		// Get references to the page element <a>: class = "load-content".
		var navLinks = document.querySelectorAll('.load-content');
		// Get references to the page element <div>: id = "content" 
		var contentElement = document.getElementById('content');
		
		/* 
		// Load initial content.
		loadContent('index.html', function() {
			// Update this history event so that the state object contains the data for the homepage.
			history.replaceState(pages.index, pages.index.title, '');
		});
		*/

		// Update the page content when the popstate event is called.
		// Popstate event is dispatched to the window every time the active history entry changes between two history entries for the same document.
		window.addEventListener('popstate', function(event) {
			updateContent(event.state);
		});


		// Attach click event listeners for each of the nav links: Summary, Content, and Reference 
		for (var i = 0; i < navLinks.length; i++) {
			navLinks[i].addEventListener('click', function(e) {
				e.preventDefault();

				// Fetch the page data using the URL in the link.
				var pageURL = this.attributes['href'].value;

				loadContent(pageURL, function() {
					var pageData = pages[pageURL.split('.')[0]];

					// Create a new history item in the url.
					history.pushState(pageData, pageData.title, pageURL);

				});
			});
		}


		// Function to load the page content via AJAX xmlhttprequest
		function loadContent(url, callback) {
			var request = new XMLHttpRequest();
			//When request is finished loading, load html content.
			request.addEventListener('load', function(feedback) {
				//Save the html content object in the pages object so that it does not need to be loaded again.
				pages[url.split('.')[0]].content = feedback.target.response;

				var pageData = pages[url.split('.')[0]];

				// Update the title and content.
				updateContent(pageData);

				// Execute the callback function.
				callback();
			});

			// Open the request and send it.
			request.open('get', 'pages/' + url, true);
			request.send();
		};


		// Function to update the page content.
		function updateContent(stateObj) {
			// Check to make sure that this state object is not null.
			if (stateObj) {
				// Assign <div> element on main resume page to the individual html content of each page
				contentElement.innerHTML = stateObj.content;
			}
			// if state object is null, then throw an error
			else { 
				throw "Content is null."
			}
		};
	}


	// Execute catch for errors.
	catch(err){ //JavaScript error.
		alert('Catch: ' + err);
	}
});