var Chance = require('chance'); 
var chance = new Chance(); 

var express = require("express"); 
var app = express(); 

app.get('/', function(req, res){
	res.send(generateLocations()); 
}); 

app.listen(3000, function(){
	console.log("Accepting HTTP requests on port 3000"); 
}); 
	
function generateLocations(){
	var numberOfLocations = chance.integer({
		min: 0, 
		max: 10
	}); 
	console.log(numberOfLocations); 
	var locations = []; 
	for(var i = 0; i < numberOfLocations; i++){
		locations.push({
			country: chance.country({ full: true }), 
			city: chance.city(),  
			address: chance.address()
		}); 
	}; 
	console.log(locations); 
	return locations; 
}
