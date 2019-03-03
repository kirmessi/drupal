/**
 * @file
 * Attaches the behaviors for the skeletontheme theme for mobile.
 */

(function ($, Drupal, drupalSettings) {
	Drupal.behaviors.skeletontheme = {
		attach: function (context, settings) {
			$("div#navigation ul.menu").mobileMenu({
				prependTo: "div#navigation",
				combine: true,
				switchWidth: drupalSettings.skeletontheme.switchwidth,
				topOptionText: drupalSettings.skeletontheme.topoptiontext
			});
		}
	};
})(jQuery, Drupal, drupalSettings);