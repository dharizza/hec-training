<?php

declare(strict_types=1);

namespace Drupal\download_files\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Provides a Download files form.
 */
final class DownloadFilesForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'download_files_download_files';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {

    $form['media'] = [
      '#type' => 'select',
      '#title' => $this->t('Select a file to download'),
      '#options' => $this->getMediaOptions(),
      '#required' => TRUE,
    ];

    $form['actions'] = [
      '#type' => 'actions',
      'submit' => [
        '#type' => 'submit',
        '#value' => $this->t('Download!'),
      ],
    ];

    return $form;
  }

  private function getMediaOptions() {
    $query_results = \Drupal::database()
      ->select('media_field_data', 'm')
      ->fields('m', ['mid', 'name'])
      ->execute()
      ->fetchAll();

    $files = [];
    foreach ($query_results as $file) {
      $files[$file->mid] = $file->name;
    }

    return $files;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void {
    // @todo Validate the form here.
    // Example:
    // @code
    //   if (mb_strlen($form_state->getValue('message')) < 10) {
    //     $form_state->setErrorByName(
    //       'message',
    //       $this->t('Message should be at least 10 characters.'),
    //     );
    //   }
    // @endcode
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    // Get the user's input.
    $media_id = $form_state->getValue('media');

    $entityTypeManager = \Drupal::entityTypeManager();
    $mediaStorage = $entityTypeManager->getStorage('media');
    $media = $mediaStorage->load($media_id);

    // $media = \Drupal::entityTypeManager()->getStorage('media')->load($media_id);
    // Get the path to the media file.
    // @todo: change field depending on media bundle.
    $uri = $media->field_media_image->entity->uri->value;

    $response = new BinaryFileResponse($uri);
    $response->setContentDisposition('attachment');
    $form_state->setResponse($response);
  }

}
