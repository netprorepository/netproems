/* 
AUTHOR: OTI VINCENT
DATE: 21/05/16
DETAIL: CONTAINS CUSTOM FUNCTIONS
*/

function updateAttemptedQuestion(){
	alert("You clicked something...");
}

function getResult(){
	var val = $('input[name="tm"]:checked').val();
	console.log(val);
	var url = "findresult.php";
	var params = "criteria=" + val;
	try{
		var xml = new XMLHttpRequest();
		xml.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				var response = this.responseText;
				var basket = document.getElementById('rightside');
				basket.innerHTML = "";
				basket.innerHTML = response;
			}
		};
		xml.open("POST", url, true);
		xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xml.send(params);
	}catch(e){
		console.error(e.Message);
	}	
}


var cartArray = [];
var cartObj = {};

function addToCart(){
	var inst = document.getElementById("inst").value;
	var addr = document.getElementById("addr").value;
	var cont = document.getElementById("cont").value;
	var coun = document.getElementById("coun").value;
	var city = document.getElementById("city").value;
	var post = document.getElementById("post").value;
	var cour = document.getElementById("courier").value;

	var rel = inst + " " + addr + " " + cont + " " + coun + " " + city + " " + post + " " + cour;
	addValues(inst,addr,cont,coun,city,post,cour);
	//console.log(rel);
	//console.log(cartArray);
	displayProduct();
}

function addValues(inst,addr,cont,coun,city,post,cour){
	cartArray.push({institution: inst, address: addr, continent: cont, country: coun, city: city, postcode: post, courier: cour});
}

function displayProduct(){
	var container = document.getElementById("tablebody");
	container.innerHTML = "";
	
	for(var i = 0; i < cartArray.length; i++){

		var tr = document.createElement("tr");
		tr.className = "even pointer";
		container.appendChild(tr);

		var td = document.createElement("td");
		td.className = "a-center";
		tr.appendChild(td);

		var input1 = document.createElement("input");
		input1.className = "flat";
		input1.setAttribute("type", "checkbox");
		input1.setAttribute("name", "table_records");
		td.appendChild(input1);

		var td0 = document.createElement("td");
		td0.innerHTML = cartArray[i]['institution'];
		tr.appendChild(td0);

		var td1 = document.createElement("td");
		td1.innerHTML = cartArray[i]['address'];
		tr.appendChild(td1);

		var td2 = document.createElement("td");
		td2.innerHTML = cartArray[i]['continent'];
		tr.appendChild(td2);

		var td6 = document.createElement("td");
		td6.innerHTML = cartArray[i]['courier'];
		tr.appendChild(td6);

		var td7 = document.createElement("td");
		td7.innerHTML = "10 - 20 Working Days";
		tr.appendChild(td7);

		var td8 = document.createElement("td");
		var img = document.createElement("img");
		img.setAttribute("src", "images/delete.png");
		img.setAttribute("class", "delimg");
		img.setAttribute("onclick", "removeA(cartArray, '"+cartArray[i]['institution']+"')");
		td8.appendChild(img);
		tr.appendChild(td8);
	}
	
}

function checkAll(ele){
	var checkboxes = document.getElementById("tablebody");
	var inputs = checkboxes.getElementsByTagName('input');
	if(ele.checked){
		for(var i = 0; i < inputs.length; i++){
			if(inputs[i].type == 'checkbox'){
				inputs[i].checked = true;
			}
		}
	}else{
		for(var i = 0; i < inputs.length; i++){
			if(inputs[i].type == 'checkbox'){
				inputs[i].checked = false;
			}
		}
	}
}

function removeFromCart(){
	var checkboxes = document.getElementById("tablebody");
	var inputs = checkboxes.getElementsByTagName('input');
	for(var i = 0; i < inputs.length; i++){
		if(inputs[i].checked = true){
			console.log(i);
		}
	}
}

function removeA(arr){
	var what, a = arguments, L = a.length, ax;
	while(L > 1 && arr.length){
		what = a[--L];
		while((ax = arr.indexOf(what)) !== -1){
			arr.splice(ax, 1);
		}
	}
}

