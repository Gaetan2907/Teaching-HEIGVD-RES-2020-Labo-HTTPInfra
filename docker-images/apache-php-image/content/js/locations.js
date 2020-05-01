$(function(){
	console.log("Loading locations"); 

	function loadLocations(){
		$.getJSON("/api/students/", function(locations){
			console.log(locations); 
			var message = "No place to show"; 
			if(locations.length > 0){
				message = locations[0].country + " " + locations[0].city; 
			}
			$(".btn").text(message); 
		}); 
	}; 
	loadLocations(); 
	setInterval(loadLocations, 2000); 
}); 

