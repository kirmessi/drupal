<?php

/**
 * @file
 * Contains \Drupal\firstmodule\Controller\FirstPageController.
 */

namespace Drupal\firstmodule\Controller;

/**
 * Provides route responses for the FirstModule module.
 */
class FirstPageController {

	/**
	 * Returns a simple page.
	 *
	 * @return array
	 *   A simple renderable array.
	 */
	public function content() {
		$element = array(
			'#markup' => 'Hello World!',
		);
		return $element;
	}

}