jQuery(function(){

var container = jQuery('#office-locations');
var tabLinks = container.find('.offices-nav-full a');
var select = container.find('#offices-nav-mobile');
var areas = container.find('.offices-map map area');
var tabs = container.find('.offices-tabs .offices-tab');
var currentTabID = null;

var showTab = function(id) {
	if (id === currentTabID) return;
	if (currentTabID !== null) {
		tabs.filter('#' + currentTabID).removeClass('is-visible');
		tabLinks.filter('[href=#' + currentTabID + ']').removeClass('highlighted');
		container.removeClass('show-' + currentTabID);
	}
	tabs.filter('#' + id).addClass('is-visible');
	tabLinks.filter('[href=#' + id + ']').addClass('highlighted');
	select.val(id);
	container.addClass('show-' + id);
	currentTabID = id;
}

tabLinks.click(function(e){
	e.preventDefault();
	showTab(jQuery(e.currentTarget).attr('href').substr(1));
});
areas.click(function(e){
	e.preventDefault();
	showTab(jQuery(e.currentTarget).attr('href').substr(1));
});
areas.mouseenter(function(e){
	container.addClass('hover-' + jQuery(e.currentTarget).attr('href').substr(1));
});
areas.mouseleave(function(e){
	container.removeClass('hover-' + jQuery(e.currentTarget).attr('href').substr(1));
});
select.change(function(e){
	e.preventDefault();
	showTab(select.val());
});

showTab(tabs.eq(0).attr('id'));

});