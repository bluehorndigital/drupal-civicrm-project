<?php

namespace Drupal\Tests\drupal_civicrm\Functional;

use Drupal\Core\Url;

/**
 * Tests Webform CiviCRM.
 *
 * @group drupal_civicrm
 */
final class WebformCivicrmTest extends CiviCrmTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'webform',
    'webform_civicrm',
  ];

  /**
   * Test creating a Webform.
   */
  public function testCreateWebform() {
    $user = $this->createUser([
      'administer CiviCRM',
      'access CiviCRM',
      'access administration pages',
      'access webform overview',
      'administer webform',
    ]);
    $this->drupalLogin($user);
    $this->drupalGet(Url::fromRoute('entity.webform.collection'));
    $this->clickLink('Add webform');
  }

}
