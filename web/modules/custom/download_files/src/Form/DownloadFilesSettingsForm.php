<?php

declare(strict_types=1);

namespace Drupal\download_files\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Download files settings for this site.
 */
final class DownloadFilesSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'download_files_download_files_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames(): array {
    return ['download_files.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $value = $this->config('download_files.settings')->get('media_types');

    $media_types = \Drupal::entityTypeManager()->getStorage('media_type')->loadMultiple();
    $types = [];
    foreach ($media_types as $key => $item) {
      $types[$key] = $item->label();
    }

    $form['types'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Media types to include in the download files form'),
      '#default_value' => empty($value) ? [] : $value,
      '#options' => $types,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void {
    // @todo Validate the form here.
    // Example:
    // @code
    //   if ($form_state->getValue('example') === 'wrong') {
    //     $form_state->setErrorByName(
    //       'message',
    //       $this->t('The value is not correct.'),
    //     );
    //   }
    // @endcode
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $this->config('download_files.settings')
      ->set('media_types', $form_state->getValue('types'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
