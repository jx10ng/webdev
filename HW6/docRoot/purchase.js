"use strict";

//onload, insert all customer and item details into HTML with this function
//retrieving JSON file information
document.addEventListener('DOMContentLoaded', function() {
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


function fillOrder(order){
/*
//Customer Information and Purchase Details
	//insert customer name
	var customer_name = document.getElementById("custname");
	customer_name.textContent = order.customer.name;
	
	//insert customer address
	var customer_add = document.getElementById("custadd");
	customer_add.textContent = order.customer.address;
*/

	//identify div that will store purchase details
	var list = document.getElementById("mydiv");
	
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
			newimagediv.className = "col-xs-0 col-md-2";
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
			newproductdiv.className = "col-xs-4 col-md-4";
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
			newcostdiv.className = "col-xs-8 col-md-6";
				//create new div node with class="col-xs-6 col-md-6 text-right" for price
				var newpricediv = document.createElement("div");
				newpricediv.id = "itempricediv" + num;
				newpricediv.className = "col-xs-6 col-md-6 text-right";
				//create a p element for price
				var newpriceelement = document.createElement("p");
				newpriceelement.id = "price" + num;
				//create text for price
				var newprice = order.itemlist["item" + num].price + " x ";
				//create a textnode for the price text
				var newpriceelement = document.createTextNode(newprice);
				//append textnode (newpriceelement) to div node (newpricediv)
				newpricediv.appendChild(newpriceelement);
				//append div element (newpricediv) to main cost div (newcostdiv)
				newcostdiv.appendChild(newpricediv);
				

				//create new div node with class="col-xs-4 col-md-4" for quantity
				var newquantitydiv = document.createElement("div");
				newquantitydiv.id = "itemquantitydiv" + num;
				newquantitydiv.className = "col-xs-4 col-md-4";
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
				newdeletediv.className = "col-xs-2 col-md-2";
				//create button element for delete
				var newdelete = document.createElement("input");
				newdelete.type = "button";
				newdelete.id = "btndelete" + num;
				newdelete.value = "Detele";
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
		document.getElementById("panelbodydiv").appendChild(document.createElement("hr"));




		//create a new div node for items details
		var newitemdiv = document.createElement("div");
		newitemdiv.id = "itemdiv" + num;
		newitemdiv.className = "divdisplay";
		
		//create a string for the descritpion, price, and quantity
		var myitem = "Description: " + order.itemlist["item"+ num].description + " Price: $" + order.itemlist["item"+num].price + " Quantity: " + order.itemlist["item"+num].quantity;
		
		//create a textnode for the description, price, and quantity
		var newitemtext = document.createTextNode(myitem);
		
		//append textnode to div node
		newitemdiv.appendChild(newitemtext);
		
		//append div node (with text) to Purchase Details div node
		list.appendChild(newitemdiv);		


		//create a input node that is a button
		var newinput = document.createElement("input");
		newinput.type = "button";
		newinput.value = "Delete Quantity";
		newinput.id = "btndlt" + num;
		newinput.index = num;
		//newinput.addEventListener('click', function(e) { fDelete1(e.target.index); }); //target references the element, newinput
		newinput.addEventListener('click', fDelete);
		
		//create a new div nod for input
		var newinputdiv = document.createElement("div");
		newinputdiv.id = "btndiv" + num;
		newinputdiv.className = "divdisplay";

		//append button to paragraph 
		newinputdiv.appendChild(newinput);
		
		//append div node (with input button) to Purchase Details div node
		list.appendChild(newinputdiv);

	}
	recal(); //calculate the Purchase Summary


	//delete items from Purchase Details
	function fDelete(e){ //e is for event
		num = e.target.index; // index of the element that triggered the event
		//if quantity > 1
		//remove one quantity from item in itemlist object
		alert("my num: " + num); //for testing purposes
		if (order.itemlist["item" + num].quantity > 0) {
			//delete 1 quantity
			order.itemlist["item" + num].quantity -= 1
			//alert("quantity: " + order.itemlist["item"+num].quantity);	

			//Change the display of quanity on screen
			var newtext = "Description: " + order.itemlist["item" + num].description + " Price: $" + order.itemlist["item"+ num].price + " Quantity: " + order.itemlist["item" + num].quantity;
			//create textnode
			var newtextnode = document.createTextNode(newtext); 
			
			//indicate div for text details
			var changediv = document.getElementById("itemdiv" + num); 

			//change text background color for testing purposes
			//changediv.style.backgroundColor = "orange";

			//replace with new item details
			changediv.replaceChild(newtextnode, changediv.childNodes[0]);

		}
		//if quanity < 1
		if (order.itemlist["item" + num].quantity < 1) {
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
		for (var i = 0; i<Object.keys(order.itemlist).length; i++){
			var num = i + 1; 
			sum = sum + (order.itemlist["item" + num].price)*(order.itemlist["item" + num].quantity);
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
		var total_amt_val = Number(item_amt.textContent) + Number(tax_amt.textContent)+ Number(ship_amt.textContent);
		total_amt.textContent = total_amt_val;
	}
}