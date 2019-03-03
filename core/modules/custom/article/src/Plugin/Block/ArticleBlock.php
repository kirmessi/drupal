<?php
/**
 * @file
 * Contains \Drupal\article\Plugin\Block\XaiBlock.
 */

namespace Drupal\article\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'article' block.
 *
 * @Block(
 *   id = "article_block",
 *   admin_label = @Translation("Article block"),
 *   category = @Translation("Custom article block example")
 * )
 */
class ArticleBlock extends BlockBase {

	/**
	 * {@inheritdoc}
	 */
	public function build() {
		$items = array(
			array('name' => 'Article one'),
			array('name' => 'Article two'),
			array('name' => 'Article three'),
			array('name' => 'Article four'),
		);
		return array(
			'#theme' => 'article_list',
			'#items' => $items,
			'#title' => 'Custom Block',
		);
	}
}
