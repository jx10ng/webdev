//order details
var order = [];
	order[0] = {description: "Hat", price: 200, partNumber: "1000"}
	order[1] = {description: "Shoe", price: 20, partNumber: "1001"}
	order[2] = {description: "Pants", price:100, partNumber: "1002"}
	order[3] = {description: "Shirt", price:10, partNumber: "1003"}
alert("order: " + JSON.stringify(order));


//customer details
var customer = {name: "Grey Wilson", address: "1234 Strawberry Creek, Berkeley, CA 94704"}


//onload, insert all customer and item details into HTML with this function
window.onload = function (){
	//insert customer name
	var customer_name = document.getElementById("custname");
	customer_name.textContent = customer.name;
	
	//insert customer address
	var customer_add = document.getElementById("custadd");
	customer_add.textContent = customer.address;

	//insert item details with description and price
	for (i = 0; i < order.length; i++){
		num = 1 + i;
		document.getElementById("item" + num).textContent = order[i].description;
		document.getElementById("amt" + num).textContent = order[i].price
	}

	//finding items cost
	var sum = 0;
	for (i = 0; i<order.length; i++){
		sum += order[i].price;
	}
	//inserting item cost
	var item_amt = document.getElementById("itemsamt");
	item_amt.textContent = sum;
	//inserting tax cost
	var tax_amt = document.getElementById("taxamt");
	tax_amt.textContent = sum*0.1;
	//inserting shipping cost
	var ship_amt = document.getElementById("shipamt");
	ship_amt.textContent = 5;
	//inserting total purchase cost
	var total_amt = document.getElementById("totalamt");
	total_amt_val = Number(item_amt.textContent) + Number(tax_amt.textContent)+ Number(ship_amt.textContent);
	total_amt.textContent = total_amt_val;

	//assigning event listeners to delete buttons
	var item1dlt = document.getElementById("btndlt1"); //
	item1dlt.addEventListener("click", removerow1); //on a click, run fDelete function on item 1
	item1dlt.addEventListener("click",recal);
	//item1dlt.addEventListener("click", myIndex);

	var item2dlt = document.getElementById("btndlt2"); //
	item2dlt.addEventListener("click", removerow2); //on a click, run fDelete function on item 2
	item2dlt.addEventListener("click",recal);
	//item2dlt.addEventListener("click", myIndex);

	var item3dlt = document.getElementById("btndlt3"); //
	item3dlt.addEventListener("click", removerow3); //on a click, run fDelete function on item 3
	item3dlt.addEventListener("click",recal);

	var item4dlt = document.getElementById("btndlt4"); //
	item4dlt.addEventListener("click", removerow4); //on a click, run fDelete function on item 4
	item4dlt.addEventListener("click",recal);
}



//Delete function
function fDelete(){
	alert("delete me");
}

/*
function myIndex(){
	var x = document.getElementsByTagName("tr");
	a = 0
	alert("my this: " + JSON.stringify(x));
	alert("Row index is: " + x[a].rowIndex);
}

*/


//Delete item1 from item table
function removerow1() {
	var myrow = document.getElementById("row1");
	while (myrow.firstChild) myrow.removeChild(myrow.firstChild);
	//alert("myrow1 index: " + myrow.rowindex)
	//Remove item 1 from object
	/*alert("order index: " + order.indexOf("item1dlt"));*/
	a = 0;//order.index;
	b = 1;//order.index + 1;
	order.splice(a,b); 
	/*alert("order row1: " + JSON.stringify(order));
	alert("order length: " + order.length);*/
	
}

//Delete item2 from item table
function removerow2() {
	var myrow = document.getElementById("row2");
	while (myrow.firstChild) myrow.removeChild(myrow.firstChild);
	//Remove item 1 from object
	/*alert("order index: " + order.indexOf("item2dlt"));*/
	a = 1;//order.index;
	b = 1;//order.index + 1;
	order.splice(a,b); 
	//alert("order row1: " + JSON.stringify(order));
	//alert("order length: " + order.length);
}

//Delete item3 from item table
function removerow3() {
	var myrow = document.getElementById("row3");
	while (myrow.firstChild) myrow.removeChild(myrow.firstChild);
	//Remove item 1 from object
	/*alert("order index: " + order.indexOf("item2dlt"));*/
	a = 2;//order.index;
	b = 2;//order.index + 1;
	order.splice(a,b); 
	//alert("order row1: " + JSON.stringify(order));
	//alert("order length: " + order.length);
}

//Delete item3 from item table
function removerow4() {
	var myrow = document.getElementById("row4");
	while (myrow.firstChild) myrow.removeChild(myrow.firstChild);
	//Remove item 1 from object
	/*alert("order index: " + order.indexOf("item2dlt"));*/
	a = 3;//order.index;
	b = 3;//order.index + 1;
	order.splice(a,b); 
	//alert("order row1: " + JSON.stringify(order));
	//alert("order length: " + order.length);
}


//recalculate Purchase Summary
function recal(){
	var sum = 0;
		for (i = 0; i<order.length; i++){
			sum += order[i].price;
		}
	//inserting item cost
	var item_amt = document.getElementById("itemsamt");
	item_amt.textContent = sum;
	//inserting tax cost
	var tax_amt = document.getElementById("taxamt");
	tax_amt.textContent = sum*0.1;
	//inserting shipping cost
	var ship_amt = document.getElementById("shipamt");
	ship_amt.textContent = 5;
	//inserting total purchase cost
	var total_amt = document.getElementById("totalamt");
	total_amt_val = Number(item_amt.textContent) + Number(tax_amt.textContent)+ Number(ship_amt.textContent);
	total_amt.textContent = total_amt_val;
}


