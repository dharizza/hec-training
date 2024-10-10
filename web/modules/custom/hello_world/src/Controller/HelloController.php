<?php

declare(strict_types=1);

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

/**
 * Returns responses for Hello world routes.
 */
final class HelloController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build($name = NULL): array {
    $node = Node::load(1);
    ksm($node->toLink());

    $output = $this->t('Hello world!');
    if ($name) {
      $output = $this->t('Hello @name!', ['@name' => $name]);
    }

    $output = $output . $node->toLink()->toString();

    $build['link'] = [
      '#type' => 'link',
      '#url' => $node->toUrl(),
      '#title' => $this->t('Node title'),
      '#weight' => 10,
    ];

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $output,
      '#weight' => 5,
    ];

    return $build;
  }

}


// $build = [
//   'header' => [],
//   'content' => [],
//   'footer' => [],
// ];

// $build['header'] = [];
// $build['content'] = [];
