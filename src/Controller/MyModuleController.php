<?php

namespace Drupal\my_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class MyModuleController extends ControllerBase implements ContainerInjectionInterface
{
  public static function create(ContainerInterface $container) {
    return new static();
  }

  public function htmlOutput()
  {
    return [
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#attributes' => [
        'style' => 'color: red',
      ],
      '#value' => $this->t('This is some text in @color', ['@color' => 'RED']),
    ];
  }

  public function jsonOutput()
  {
    $data = [
      'type' => 'text',
      'message' => 'Hello JSON!',
    ];

    return new JsonResponse($data);
  }

}
