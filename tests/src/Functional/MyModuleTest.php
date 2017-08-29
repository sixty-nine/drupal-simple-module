<?php

namespace Drupal\Tests\my_module\Functional;

use Drupal\Tests\BrowserTestBase;


/**
 * @group my_module
 * @ingroup my_module
 */
class MyModuleTest extends BrowserTestBase {

  public static $modules = ['my_module'];

  protected $profile = 'minimal';

  public function testOutputHtml()
  {
    // Request a page in Drupal
    $this->drupalGet('/my-module/output-html');

    // Check the request completed successfully
    $this->assertSession()->statusCodeEquals(200);

    // Check we have a paragraph in red
    $nodes = $this->xpath('//p[@style="color: red"]');
    $this->assertEquals(1, \count($nodes));

    // Check the content of that paragraph is what we expect
    $node = reset($nodes); // Get the first node in the array
    $this->assertEquals('This is some text in RED', $node->getHtml());
  }

  public function testOutputJson()
  {
    $this->drupalGet('/my-module/output-json');
    $this->assertSession()->statusCodeEquals(200);

    $json = $this->getSession()->getPage()->getContent();
    $array = json_decode($json, true);

    $this->assertTrue(is_array($array));
    $this->assertCount(2, $array);
    $this->assertArrayHasKey('type', $array);
    $this->assertArrayHasKey('message', $array);
    $this->assertEquals('text', $array['type']);
    $this->assertEquals('Hello JSON!', $array['message']);
  }
}
