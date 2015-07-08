window.onsubmit=validateForm;

function updateMSRPout() {
    var msrp = document.getElementById("msrp").value;
    document.getElementById("MSRPout").innerHTML = "$" + msrp;
}

function updateMPGout() {
    var mpg = document.getElementById("mpg").value;
    document.getElementById("MPGout").innerHTML = "" + mpg + " MPG";
}

function moreInfo(year, manufacturer, model, image, imgpath, category, size, msrp, mpg, stars, fuel) {
    alert("Year: " + year + 
    	"Manufacturer: " + manufacturer + 
    	"Model: " + model + 
    	"Category: " + category + 
    	"Size: " + size + 
    	"MSRP: " + msrp + 
    	"MPG Combined: " + mpg + 
    	"Safety Rating: " + stars + 
    	"Fuel: " + fuel
    );
}

function validateForm() {
    if (document.getElementById("categories").selectedIndex == -1) {
  		alert("Please select a category.");
  		return false;
	}
	if (document.getElementById("sizes").selectedIndex == -1) {
  		alert("Please select a size.");
  		return false;
	}
	if (document.getElementById("fuels").selectedIndex == -1) {
  		alert("Please select a fuel.");
  		return false;
	}
	return true;
}