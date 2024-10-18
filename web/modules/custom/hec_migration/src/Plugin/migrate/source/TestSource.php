<?php

declare(strict_types=1);

namespace Drupal\hec_migration\Plugin\migrate\source;

use Drupal\Core\Database\Query\SelectInterface;
use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * The 'test_source' source plugin.
 *
 * @MigrateSource(
 *   id = "test_source",
 *   source_module = "hec_migration",
 * )
 */
final class TestSource extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query(): SelectInterface {
    return $this->select('example', 'e')
      ->fields('e', ['id', 'name', 'status']);
  }

  /**
   * {@inheritdoc}
   */
  public function fields(): array {
    return [
      'id' => $this->t('The record ID.'),
      'name' => $this->t('The record name.'),
      'status' => $this->t('The record status'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getIds(): array {
    $ids['id'] = [
      'type' => 'integer',
      'unsigned' => TRUE,
      'size' => 'big',
    ];
    return $ids;
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row): bool {
    // @DCG
    // Modify the row here if needed.
    // Example:
    // @code
    //   $name = $row->getSourceProperty('name');
    //   $row->setSourceProperty('name', Html::escape('$name'));
    // @endcode
    return parent::prepareRow($row);
  }

}
