$(document).ready(function(){
	$('#map').usmap({
		stateHoverStyles: {
			fill: '#985173'
		},
		labelBackingHoverStyles: {
			fill: '#985173'
		},
		click: function(event, data) {
			window.location.assign('?state='+data.name);
		}
	});
});