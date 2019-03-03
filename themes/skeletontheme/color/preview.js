
(function ($, Drupal) {
  Drupal.color = {
    logoChanged: false,
    callback: function(context, settings, $form) {

		// Text preview.
		$('#preview', $form).css('color', $form.find('input[name="palette[text]"]').val());
		$('#preview a', $form).css('color', $form.find('input[name="palette[link]"]').val());
		$('#preview a:hover', $form).css('color', $form.find('input[name="palette[linkhover]"]').val());
		$('#preview h1', $form).css('color', $form.find('input[name="palette[headings]"]').val());
		$('#preview #site-name a', $form).css('color', $form.find('input[name="palette[sitename]"]').val());
		$('#preview #site-name a:hover', $form).css('color', $form.find('input[name="palette[sitenamehover]"]').val());
		$('#preview #site-slogan', $form).css('color', $form.find('input[name="palette[slogan]"]').val());
		$('#wrapper', $form).css('border-color', $form.find('input[name="palette[bodyborder]"]').val());
		$('#wrapper-inside', $form).css('border-color', $form.find('input[name="palette[wrapborder]"]').val());
		$('#preview-footer', $form).css('border-color', $form.find('input[name="palette[footerborder]"]').val());
		$('#preview-footer', $form).css('background-color', $form.find('#palette input[name="palette[footerbackground]"]').val());
		
    }
  };
})(jQuery, Drupal);