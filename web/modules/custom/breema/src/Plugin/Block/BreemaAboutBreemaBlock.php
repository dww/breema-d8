<?php

namespace Drupal\breema\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\node\Entity\Node;

/**
 * A site-wide block for 'About Breema' footer text.
 *
 * @Block(
 *   id = "about_breema_block",
 *   admin_label = @Translation("About Breema text"),
 *   category = @Translation("Breema"),
 * )
 */
class BreemaAboutBreemaBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $node = Node::load(1);
    $options = [
      'label' => 'hidden',
      'type' => 'text_summary_or_trimmed',
    ];
    return [
      '#cache' => ['tags' => ['node:1']],
      'about' => $node->get('body')->view($options),
      'more' => [
        '#type' => 'link',
        '#title' => $this->t('Read more<span class="visually-hidden"> about Breema</span>'),
        '#url' => $node->toUrl(),
      ],
    ];
  }
}
