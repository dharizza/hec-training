<?php

declare(strict_types=1);

namespace Drupal\youtube_video_formatter\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\Attribute\FieldFormatter;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * Plugin implementation of the 'Youtube Video Formatter' formatter.
 */
#[FieldFormatter(
  id: 'youtube_field_formatter',
  label: new TranslatableMarkup('Youtube Video Formatter'),
  field_types: ['string'],
)]
final class YoutubeFieldFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings(): array {
    $setting = ['width' => 560];
    return $setting + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state): array {
    // $elements['foo'] = [
    //   '#type' => 'textfield',
    //   '#title' => $this->t('Foo'),
    //   '#default_value' => $this->getSetting('foo'),
    // ];
    $elements['width'] = [
      '#type' => 'number',
      '#title' => $this->t('Width of the video box'),
      '#default_value' => $this->getSetting('width'),
    ];

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary(): array {
    return [
      $this->t('Width: @width', ['@width' => $this->getSetting('width')]),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode): array {
    $element = [];
    foreach ($items as $delta => $item) {
      $element[$delta] = [
        '#theme' => 'youtube_video',
        '#youtube_id' => $item->value,
        '#width' => $this->getSetting('width'),
      ];
    }
    return $element;
  }

}
