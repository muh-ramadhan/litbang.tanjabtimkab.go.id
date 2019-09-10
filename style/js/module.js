jQuery(function(){

var container = jQuery('#carousel');
var links = container.find('.carousel-links a');
var tabs = container.find('.carousel-tab');
var previous = container.find('button.previous');
var next = container.find('button.next');
var currentTabID = null;
var currentTabIndex = null;
var rotationInterval = null;
var rotationSpeed = 5000;

var showTab = function(id) {
	if (id === currentTabID) return;
	tabs.removeClass('is-visible').filter('#' + id).addClass('is-visible');
	links.removeClass('highlighted').filter('[href=#' + id + ']').addClass('highlighted');
	currentTabID = id;
	for (var i = 0; i < tabs.length; i++) {
		if (tabs.eq(i).attr('id') === id) {
			currentTabIndex = i;
			break;
		}
	}
}

var startRotation = function(){
	return false; //Temp rotation disable - per ticket #32108
	if (rotationInterval === null) {
		rotationInterval = window.setInterval(function(){
			showTab(tabs.eq(currentTabIndex === tabs.length - 1 ? 0 : currentTabIndex + 1).attr('id'));
		}, rotationSpeed);
	}
};
var stopRotation = function(){
	if (rotationInterval !== null) {
		window.clearInterval(rotationInterval);
		rotationInterval = null;
	}
};

links.click(function(e){
	e.preventDefault();
	stopRotation();
	showTab(jQuery(e.currentTarget).attr('href').substr(1));
});
previous.click(function(e){
	e.preventDefault();
	stopRotation();
	showTab(tabs.eq(currentTabIndex === 0 ? tabs.length - 1 : currentTabIndex - 1).attr('id'));
});
next.click(function(e){
	e.preventDefault();
	stopRotation();
	showTab(tabs.eq(currentTabIndex === tabs.length - 1 ? 0 : currentTabIndex + 1).attr('id'));
});
tabs.click(function(){
	stopRotation();
});

startRotation();
showTab(tabs.eq(0).attr('id'));

});