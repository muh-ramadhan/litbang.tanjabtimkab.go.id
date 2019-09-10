jQuery(function(){

var container = jQuery('#get-connected');
var links = container.find('.tab-list a');
var tabs = container.find('.tabs .tab');
var currentTabID = null;

var showTab = function(id) {
	if (id === currentTabID) return;
	tabs.removeClass('is-visible').filter('#' + id).addClass('is-visible');
	links.removeClass('highlighted').filter('[href=#' + id + ']').addClass('highlighted');
	currentTabID = id;
}

links.click(function(e){
	e.preventDefault();
	showTab(jQuery(e.currentTarget).attr('href').substr(1));
});

showTab(tabs.eq(0).attr('id'));

});