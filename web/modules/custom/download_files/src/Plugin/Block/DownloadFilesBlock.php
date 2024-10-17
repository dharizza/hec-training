<?php

declare(strict_types=1);

namespace Drupal\download_files\Plugin\Block;

use Drupal\Core\Block\Attribute\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Provides a download files block block.
 */
#[Block(
  id: 'download_files_block',
  admin_label: new TranslatableMarkup('Download Files Block'),
  category: new TranslatableMarkup('Custom'),
)]
final class DownloadFilesBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {

    $form = \Drupal::formBuilder()->getForm('\Drupal\download_files\Form\DownloadFilesForm');

    $form['#title'] = $this->t('Get Your Files Here!');
    return $form;
  }

  public function access(AccountInterface $account, $return_as_object = FALSE) {
    // @TODO: change to right permission.
    return AccessResult::allowedIfHasPermission($account, 'add tags to articles');
  }

}
