//retrieving JSON file information
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        order = JSON.parse(this.responseText);
        //document.getElementById("demo").innerHTML = order.customer.name;
        //for testing purposes
    }
};
xmlhttp.open("GET", "getOrder.json", true);
xmlhttp.send();


//object constructor for items
function item (description, price, quantity){
	this.description = description;
	this.price = price;
	this.quantity = quantity;
}


//object constructor for customer
function customer (name, address){
	this.name = name;
	this.address = address;
}



//------------------------------------------------------------------
/*
function get() {
  // Return a new promise.
  return new Promise( function(resolve, reject) {
    var req = new XMLHttpRequest();    // Setup to get JSON (or whatever) from a URL
    req.open('GET', "myOrder.json");

	// This is less convenient, but works in every browser:
	//
	// These are defined in XMLHttpRequest:
	//	  const unsigned short UNSENT = 0;
	//	  const unsigned short OPENED = 1;
	//	  const unsigned short HEADERS_RECEIVED = 2;
	//	  const unsigned short LOADING = 3;
	//	  const unsigned short DONE = 4;
	//
	// xhr.onreadystatechange = function () {
    //		if (xhr.readyState == DONE && xhr.status == 200) {
	//        alert(xhr.responseText);
	//     }
	//	}
	//
	// The following event handlers should be avilable:
	//		onloadstart, onprogress, onabort, onerror, onload, ontimeout, onloadend
	//

    req.onload = function() {			// even on 404 errors (200==real success)

      if (req.status == 200) {
        resolve(req.response);	 		// Resolve the promise with the response text
      }
      else {
        reject( Error(req.statusText) );	// Reject with the status text which will hopefully be a meaningful error
      }
    };

    req.onerror = function() {			 // Network (not HTTP) errors
      reject( Error("Network Error") );
    };

    // Make the request
    req.send();
    document.getElementById("demo").innerHTML = order.itemlist.item1.description;
  });
}

function post( url, json ) {
  return new Promise( function(resolve, reject) {

    var req = new XMLHttpRequest();    // Setup to get JSON (or whatever) from a URL
	req.setRequestHeader("Content-Type", "application/json" );
    req.open('POST', "getOrder.json");

    req.onload = function() {			// even on 404 errors (200==real success)

      if (req.status == 200) {
        resolve( req.response ); 		// Resolve the promise with the response text
      }
      else {
        reject( Error(req.statusText) );	// Reject with the status text which will hopefully be a meaningful error
      }
    };

    req.onerror = function() {			 // Network (not HTTP) errors
      reject( Error("Network Error") );
    };

    // Make the request. If you have a local JSON object:
	//
	// json = JSON.stringify( {name:"John Rambo", time:"2pm"} );


    req.send( json );
  });
}
*/



//-------------------------------------------------------------------
//alert("order: " + JSON.stringify(order));


//onload, insert all customer and item details into HTML with this function
window.onload = function (){
	//insert customer name
	var customer_name = document.getElementById("custname");
	customer_name.textContent = order.customer.name;
	
	//insert customer address
	var customer_add = document.getElementById("custadd");
	customer_add.textContent = order.customer.address;

	//identify div that will store purchase details
	list = document.getElementById("mydiv");
	
	//create Purchase Details with for loop
	for (i = 0; i < Object.keys(order.itemlist).length; i++){
		var num = i + 1;
		
		//create a new div node for items details
		newitemdiv = document.createElement("div");
		newitemdiv.id = "itemdiv" + num;
		newitemdiv.className = "divdisplay";
		
		//create a string for the descritpion, price, and quantity
		var myitem = "Description: " + order.itemlist["item"+num].description + " Price: $" + order.itemlist["item"+num].price + " Quantity: " + order.itemlist["item"+num].quantity;
		
		//create a textnode for the description, price, and quantity
		newitemtext = document.createTextNode(myitem);
		
		//append textnode to div node
		newitemdiv.appendChild(newitemtext);
		
		//append div node (with text) to Purchase Details div node
		list.appendChild(newitemdiv);		


		//create a input node that is a button
		newinput = document.createElement("input");
		newinput.type = "button";
		newinput.value = "Delete Quantity";
		newinput.id = "btndlt" + num;
		newinput.index = num;
		//newinput.addEventListener('click', function(e) { fDelete1(e.target.index); }); //target references the element, newinput
		newinput.addEventListener('click', fDelete);
		
		//create a new div nod for input
		newinputdiv = document.createElement("div");
		newinputdiv.id = "btndiv" + num;
		newinputdiv.className = "divdisplay";

		//append button to paragraph 
		newinputdiv.appendChild(newinput);
		
		//append div node (with input button) to Purchase Details div node
		list.appendChild(newinputdiv);
	}
	recal(); //calculate the Purchase Summary
}



//delete items from Purchase Details
function fDelete(e){ //e is for event
	num = e.target.index; // index of the element that triggered the event
	//if quantity > 1
	//remove one quantity from item in itemlist object
	//alert("num: " + num); 
	if (order.itemlist["item"+num].quantity > 0) {
		//delete 1 quantity
		order.itemlist["item"+num].quantity -= 1
		//alert("quantity: " + order.itemlist["item"+num].quantity);	

		//Change the display of quanity on screen
		newtext = "Description: " + order.itemlist["item"+num].description + " Price: $" + order.itemlist["item"+num].price + " Quantity: " + order.itemlist["item"+num].quantity;
		//create textnode
		newtextnode = document.createTextNode(newtext); 
		
		//indicate div for text details
		var changediv = document.getElementById("itemdiv" + num); 

		//change text background color for testing purposes
		//changediv.style.backgroundColor = "orange";

		//replace with new item details
		changediv.replaceChild(newtextnode, changediv.childNodes[0]);

	}
	//if quanity < 1
	if (order.itemlist["item"+num].quantity < 1) {
		//indicate div for text details
		var changediv = document.getElementById("itemdiv" + num); 

		//indicate div for button
		var btndiv = document.getElementById("btndiv" + num); 

		//disable display of text details
		changediv.style.display = "none";

		//disable display of button
		btndiv.style.display = "none";
	}
	recal();
}



//recalculate Purchase Summary
function recal(){
	var sum = 0;
		for (i = 0; i<Object.keys(order.itemlist).length; i++){
			num = i+1; 
			sum += (order.itemlist["item"+num].price)*(order.itemlist["item"+num].quantity);
		}

	//inserting item cost
	var item_amt = document.getElementById("itemsamt");
	item_amt.textContent = sum;
	
	//inserting tax cost
	var tax_amt = document.getElementById("taxamt");
	tax_amt.textContent = sum*0.1;
	
	//inserting shipping cost
	var ship_amt = document.getElementById("shipamt");
	if (sum == 0 ) {
		ship_amt.textContent = 0; //no cost for shipping if there are no items in list
	}
	else {
		ship_amt.textContent = 5; 
	}
	
	//inserting total purchase cost
	var total_amt = document.getElementById("totalamt");
	total_amt_val = Number(item_amt.textContent) + Number(tax_amt.textContent)+ Number(ship_amt.textContent);
	total_amt.textContent = total_amt_val;
}



