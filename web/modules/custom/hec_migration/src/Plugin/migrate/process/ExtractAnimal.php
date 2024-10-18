<?php

declare(strict_types=1);

namespace Drupal\hec_migration\Plugin\migrate\process;

use Drupal\migrate\Attribute\MigrateProcess;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;

/**
 * Provides an extract_animal plugin.
 *
 * Usage:
 *
 * @code
 * process:
 *   bar:
 *     plugin: extract_animal
 *     source: foo
 * @endcode
 */
#[MigrateProcess('extract_animal')]
final class ExtractAnimal extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property): mixed {
    $animal_list = [
      'duck' => 'Duck',
      'goose' => 'Goose',
      'ptarmigan' => 'Ptarmigan',
      'mergansers' => 'Mergansers',
    ];
    foreach ($animal_list as $code => $label) {
      if (strpos($value, $code) !== FALSE) {
        return $label;
      }
    }
    return NULL;
  }

}
