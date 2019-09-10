// footer sections
jQuery(function(){

var container = jQuery('footer');
var sectionButtons = container.find('.section button[rel=toggle]');
sectionButtons.click(function(e){
	e.preventDefault();
	jQuery(e.currentTarget).parents('.section').toggleClass('is-expanded');
});

container.find('.section-group .section:first-child').addClass('is-expanded');

});

// top menu 
jQuery(function(){

var $window = jQuery(window);
var navWrapper = jQuery('header .navbar-wrapper');
var nav = jQuery('header .navbar');

var detectScrolled = function(){
	var docScrollTop = jQuery(document).scrollTop();
	var navOffset = navWrapper.offset().top;
	//alert(docScrollTop);
	if (docScrollTop > navOffset) {
		nav.addClass('is-scrolled');
	}
	else {
		nav.removeClass('is-scrolled')
	}
}
$window.on('scroll', function(){
	detectScrolled();
});
detectScrolled();

});

// resize menus
jQuery(function(){

var $window = jQuery(window);
var container = jQuery('header .navbar-collapse');
var navs = container.find('.navbar-nav > li');
var minWidth = 768;

var fixMenus = function(){
	var windowWidth = $window.width();
	var affectedNavs = navs.filter(':not(.nav_home):not(.nav_search)').children('a');
	// reset
	affectedNavs.css({
		//'padding-left': 0,
		//'padding-right': 0
	});
	// we need to be in non-mobile mode for this
	if (windowWidth >= minWidth) {
		var navsWidth = 0;
		for (var i = 0; i < navs.length; i++) {
			navsWidth += navs.eq(i).width();
		}
		var delta = container.width() - navsWidth;
		// subtract 1 to allow for browser inconsistencies with fractional margins
		var padding = ((delta / affectedNavs.length) / 2) - 1;
		if (padding < 0) padding = 0;
		affectedNavs.css({
			'padding-left': padding,
			'padding-right': padding
		});
	}
};

$window.on('resize', function(){
	fixMenus();
});
fixMenus();

});

// search form
jQuery(function(){

var container = jQuery('header .nav_search form');
var input = container.find('input[type=text]');

// prevent clicking on the form from closing the menu
container.click(function(e){
	e.stopPropagation();
});

input.focus(function(){
	container.addClass('has-focus');
}).blur(function(){
	container.removeClass('has-focus');
	if (input.val() !== '') {
		container.addClass('has-text');
	}
	else {
		container.removeClass('has-text');
	}
});

});