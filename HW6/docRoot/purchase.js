"use strict";

//on load of DOM, insert all customer and item details into HTML with this function
//retrieving JSON file information
document.addEventListener('DOMContentLoaded', function() {
	var order;
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onload = function() {
    	if (xmlhttp.status == 200) { //this.readyState == 4 not used with onload handler
	    	order = JSON.parse(xmlhttp.responseText);
	    	fillOrder(order);
    	}
	}
	xmlhttp.open("GET", "getOrder.json", true);
	xmlhttp.send();

	// AJAX NAVIGATION
	try {
		//AJAX Nav - Step 1: create pages object to store information
 		var pages = {
			products: {title: "Products", content: ""},
			account: {title: "Account", content: ""},
			cart: {title: "Cart", content: ""},
			aboutus: {title: "About Us", content: ""},
			contact: {title: "Contact", content: ""},
			references: {title: "References", content: ""}
		}
		//AJAX Nav - Step 2: identify each navigation point from html
		// Get references to the page element <a>: class = "load-content".
		var navLinks = document.querySelectorAll('.load-content');

		//AJAX Nav - Step 3: identify where new content will be loaded
		// Get references to the page element <div>: id = "content" 
		var contentElement = document.getElementById('content');

		// Attach click event listeners for each of the navigation point: Summary, Content, and Reference 
		for (var i = 0; i < navLinks.length; i++) {
			//AJAX Nav - Step 4: create event listener for each navigation point
			navLinks[i].addEventListener('click', function(e) {
				e.preventDefault();

				//AJAX Nav - Step 5: get the url from the <a href> of the html page
				//Fetch the page data using the URL in the link. 
				//pageURL example are contact.html, product.html, account.html, cart.html, etc.
				var pageURL = this.attributes['href'].value;
				//alert("pageURL: " + pageURL);

				//AJAX Nav - Step 6: use the url from <a href> of the html page for function loadContent 
				loadContent(pageURL, function() {
					
					//AJAX Nav - Step 14: perform callback function, identify state object variable for page object's object (example: page[contact], page[product], page[account], page[cart], etc)
					//same as Step 9
					var pageData = pages[pageURL.split('.')[0]];
					//alert("pageURL.split('.')[0]: " + pageURL.split('.')[0]);

					//AJAX Nav - Step 15: Create a new history item in the url with state object, title, url of selected navLink[i]
					history.pushState(pageData, pageData.title, pageURL);
				});
			});
		} // End of for loop
			
/*		//event handler for clicking the cart page (navLinks[2] == cart element id) and generating purchase order display
		navLinks[2].addEventListener('click', function(e) {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onload = function() {
		    	if (xmlhttp.status == 200) { //this.readyState == 4 not used with onload handler
			    	var order = JSON.parse(xmlhttp.responseText);
			    	fillOrder(order);
		    	}
			}
			xmlhttp.open("GET", "getOrder.json", true);
			xmlhttp.send();
		});
*/

		//update the page content when the popstate event is called while doing forward or backward in history.
		//popstate event is dispatched to the window every time the active history entry changes between two history entries for the same document.
		//the event is only triggered when the user navigates between two history entries for the same document.
		window.addEventListener('popstate', function(event) {
			updateContent(event.state);
		});


		// Function to load the page content via AJAX xmlhttprequest
		function loadContent(url, callback) {
			//AJAX Nav - Step 7:  perform xmlhttprequest
			var pagerequest = new XMLHttpRequest();
			//When request is finished loading, load html content.
			pagerequest.addEventListener('load', function() {
				//AJAX Nav - Step 8: Save the html content from the xmlhttprequest to the page's object content to reduce reloading.
				//url.split('.')[0] examples: contact, product, account, cart, etc.
				//pages[url.split('.')[0]].content is pages object > object (example: contact, product, account, cart, etc) > content object

				pages[url.split('.')[0]].content = pagerequest.response;

				//AJAX Nav - Step 9: assign variable to page object's object (example: page[contact], page[product], page[account], page[cart], etc)
				var pageData = pages[url.split('.')[0]];

				//AJAX Nav - Step 10: Update the title and content with the function updateContent.
				updateContent(pageData);

				//AJAX Nav - Step 13: 1Execute the callback function.
				callback();
			});

			//Open the request from file and send it asynchronously ("true" value" in third argument).
			pagerequest.open('get', 'pages/' + url, true);
			pagerequest.send();
		};


		// Function to update the main html page with the page object's object content.
		function updateContent(pageObjectObject) {
			//AJAX Nav - Step 11: Check to make sure that this pageObjectObject is not null.

			if (pageObjectObject) {
				//AJAX Nav - Step 12: Assign <div> element on main html page to the page object's object content
				contentElement.innerHTML = pageObjectObject.content;

			}
			//if page object's object is null (aka state object), then throw an error
			else { 
				throw "State Object is null."
			}
		};
	} // End of try

	// Execute catch for errors.
	catch(err){ //JavaScript error.
		alert('Catch: ' + err);
	}

}); // End of 'DOMContentLoaded' event listener


// PURCHASE ORDER GENERATION
function fillOrder(order){
	//call function to display purchase items
	displayOrder(order);
	//call function to calculate the purchase summary
	recal(order); 

	// Function to display the purchase order
	function displayOrder(order){
		//create Purchase Details with for loop
		for (var i = 0; i < Object.keys(order.itemlist).length; i++){
			var num = i + 1;

			//create a new div node for each row of items, className = "row"
			var newrowdiv = document.createElement("div"); 
			newrowdiv.id = "itemrowdiv" + num;
			newrowdiv.className = "row";

				//create a new div node with class="col-xs-0 col-md-2 for image
				var newimagediv = document.createElement("div");
				newimagediv.id = "itemimagediv" + num;
				newimagediv.className = "col-xs-0 col-sm-2 col-md-2";
				//create new img element for images
				var newimage = document.createElement("img");
				newimage.className = "img-responsive";
				newimage.src = "http\:\/\/placehold.it\/100x70";
				//append image (newimage) node to image div(newimagediv)
				newimagediv.appendChild(newimage);
				//append image div (newimagediv) node to row div(newrowdiv)
				newrowdiv.appendChild(newimagediv);


				//create new div node with class="col-xs-4 col-md-4" for product name
				var newproductdiv = document.createElement("div");
				newproductdiv.id = "itemproductdiv" + num;
				newproductdiv.className = "col-xs-4 col-sm-4 col-md-4";
				//create a p element for product name
				var newproductelement = document.createElement("p");
				newproductelement.id = "product_name" + num;
				newproductelement.className = "text";
				//create text for product 
				var newproductname = order.itemlist["item"+ num].description + "";

				//create a textnode for the product text
				var newproducttext = document.createTextNode(newproductname);
				//append textnode (newproducttext) to div node (newproductelement)
				newproductelement.appendChild(newproducttext);
				//append p element (newproductname) to product name div (newproductdiv)
				newproductdiv.appendChild(newproductelement);
				//append product name div (newproductdiv) node to row div(newrowdiv)
				newrowdiv.appendChild(newproductdiv);


				//create new div node with class="col-xs-8 col-md-6" for price, quantity, delete button
				var newcostdiv = document.createElement("div");
				newcostdiv.id = "itemcostdiv" + num;
				newcostdiv.className = "col-xs-8 col-sm-6 col-md-6";
					//create new div node with class="col-xs-6 col-md-6 text-right" for price
					var newpricediv = document.createElement("div");
					newpricediv.id = "itempricediv" + num;
					newpricediv.className = "col-xs-6 col-sm-6 col-md-6 text-right";
					//create a p element for price
					var newpriceelement = document.createElement("p");
					newpriceelement.id = "price" + num;
					//create text for price
					var newprice = "$" + order.itemlist["item" + num].price + " x ";
					//create a textnode for the price text
					var newpriceelement = document.createTextNode(newprice);
					//append textnode (newpriceelement) to div node (newpricediv)
					newpricediv.appendChild(newpriceelement);
					//append div element (newpricediv) to main cost div (newcostdiv)
					newcostdiv.appendChild(newpricediv);
					

					//create new div node with class="col-xs-4 col-md-4" for quantity
					var newquantitydiv = document.createElement("div");
					newquantitydiv.id = "itemquantitydiv" + num;
					newquantitydiv.className = "col-xs-4 col-sm-4 col-md-4";
					//create an input element for quantity
					var newquantity = document.createElement("input");
					newquantity.id = "quantity" + num;
					newquantity.className = "form-control input-sm";
					//create text for quantity
					newquantity.value = order.itemlist["item"+num].quantity;
					//append input element (newquantity) to quantity div (newquantitydiv)
					newquantitydiv.appendChild(newquantity);
					//append div element (newquantitydiv) to main cost div (newcostdiv)
					newcostdiv.appendChild(newquantitydiv);


					//create new div node with class="col-xs-2 col-md-2" for delete
					var newdeletediv = document.createElement("div");
					newdeletediv.id = "itemquantitydiv" + num;
					newdeletediv.className = "col-xs-2 col-sm-2 col-md-2";
					//create button element for delete
					var newdelete = document.createElement("input");
					newdelete.type = "button";
					newdelete.id = "btndelete" + num;
					newdelete.value = "X";
					newdelete.className = "delete_text"
					/*newdelete.className = "btn btn-link btn-md";*/ //note: span removed to allow for fDelete to work
					newdelete.index = num;
					//create span element for delete button
					/*var newdeletespan = document.createElement("span");*/
					/*newdeletespan.className = "glyphicon glyphicon-trash";*/
					/*newdelete.appendChild(newdeletespan);*/
					//append input element (newdelete) to delete div (newdeletediv)
					newdeletediv.appendChild(newdelete);
					//append div element (newdeletediv) to main cost div (newcostdiv)
					newcostdiv.appendChild(newdeletediv);
					//event listenr for clicking of the delete button
					newdelete.addEventListener('click', fDelete);

			//append main cost div (newcostdiv) node to main row div(newrowdiv)
			newrowdiv.appendChild(newcostdiv);
			//append main row div(newrowdiv) to the panel panel div
			document.getElementById("panelbodydiv").appendChild(newrowdiv);
			//create hr element and append to the panel panel div
			var newhr = document.createElement("hr");
			newhr.id = "hr" + num;
			document.getElementById("panelbodydiv").appendChild(newhr);
		}
	} // End of Function displayOrder()



	// Function to delete items from Purchase Details
	function fDelete(e){ //e is for event
		var num = e.target.index; // index of the element that triggered the event
		//if quantity > 1
		//remove one quantity from item in itemlist object
		//alert("my num: " + num); //for testing purposes

		if (order.itemlist["item" + num].quantity > 0) {
			//delete 1 quantity
			order.itemlist["item" + num].quantity -= 1
			//alert("quantity: " + order.itemlist["item"+num].quantity);	

			//Change the display of quanity on screen
			//create a new input element for the quantity
			var changequantity = document.createElement("input");
			changequantity.id = "quantity" + num;
			changequantity.className = "form-control input-sm";
			//create value for quantity with the new num
			changequantity.value = order.itemlist["item" + num].quantity;
			//identify the parent node of the current quantity input before deletion
			var changequantitydiv = document.getElementById("itemquantitydiv" + num);
			//replace the current quantity input value with the changed quantity input value
			changequantitydiv.replaceChild(changequantity, changequantitydiv.childNodes[0]);
		}
		//if quanity < 1, remove display of item from screen
		if (order.itemlist["item" + num].quantity < 1) {
			var changerowdiv = document.getElementById("itemrowdiv" + num); 
			//disable display of row
			changerowdiv.style.display = "none";
			//disable hr that follows each row
			var changehr = document.getElementById("hr" + num);
			changehr.style.display = "none";
		}
		recal(order);
	} // End of Function fDelete()



	// Function to recalculate Purchase Summary
	function recal(order){
		var sum = 0;
		for (var i = 0; i<Object.keys(order.itemlist).length; i++){
			var num = i + 1; 
			sum = sum + (order.itemlist["item" + num].price)*(order.itemlist["item" + num].quantity);
		}

		//inserting item cost
		var item_amt = document.getElementById("itemsamt");
		var item_cost = sum;
		item_amt.textContent = "$" + item_cost;
		
		//inserting tax cost
		var tax_amt = document.getElementById("taxamt");
		var tax_cost = (sum*0.1);
		tax_amt.textContent = "$" + tax_cost;
		
		//inserting shipping cost
		var ship_amt = document.getElementById("shipamt");
		if (sum == 0 ) {
			var ship_cost = 0;
			ship_amt.textContent = "$" + ship_cost; //no cost for shipping if there are no items in list
		}
		else {
			var ship_cost = 5;
			ship_amt.textContent = "$" + ship_cost; 
		}
	
		//inserting total purchase cost
		var total_amt = document.getElementById("totalamt");
		var total_amt_val = Number(item_cost) + Number(tax_cost)+ Number(ship_cost);
		total_amt.textContent = "$" + total_amt_val;
	} // End of Function recal()

} // End of Function fillOrder()