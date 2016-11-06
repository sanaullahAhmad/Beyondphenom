$( document ).ready(function() {
    var div = document.getElementById("dom-target");
    var url = div.textContent;
    // alert(url);
    //console.log(url);
    prototypefabric.createOverlay_front(url);
    $('#ex1').slider({
	formatter: function(value) {
		return 'Current value: ' + value;
	}
});
});