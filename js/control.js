$('#map').usmap({
  // The click action
  click: function(event, data) {
    var state = $('#clicked-state').
      //.parent().effect('highlight', {color: '#D3D3D3'}, 2000);
  }
});

/*$(document).ready(function(){

	$('#map').on('usmapclick', function(event, data) {
		// Output the abbreviation of the state name to the console
		window.location.assign("index.php?state=" + data.name);
	});

});*/