<?php

namespace Drupal\breema\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;
use Drupal\user\Entity\User;


/**
 * A block for users to manage their own Breema Directory entry.
 *
 * @Block(
 *   id = "directory_entry_block",
 *   admin_label = @Translation("Breema Directory entry"),
 *   category = @Translation("Breema"),
 * )
 */
class BreemaDirectoryEntryBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $block = [
      '#cache' => [
        'contexts' => ['user'],
      ],
      '#attached' => [
        'library' => [
          'breema/block.directory_entry',
          'breema/directory_entry',
        ],
      ],
    ];
    $current_user = \Drupal::currentUser();
    $current_user_entity = User::load($current_user->id());
    $directory_entries = $current_user_entity->get('field_directory_entry')->referencedEntities();
    if (!empty($directory_entries)) {
      $directory_entry = array_pop($directory_entries);
      $links = _breema_get_directory_entry_action_links($directory_entry);
      $view_builder = \Drupal::entityManager()->getViewBuilder('node');
      return $block + [
        'teaser' => $view_builder->view($directory_entry, 'teaser'),
      ] + $links;
    }
    else {
      return $block + _breema_get_directory_entry_action_links(NULL, TRUE);
    }
  }
}
