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
		newrowdiv.id = "itemdiv" + num;
		newrowdiv.className = "row";







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
		//alert("num: " + num); 
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