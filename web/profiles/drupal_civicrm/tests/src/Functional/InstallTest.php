<?php

namespace Drupal\Tests\drupal_civicrm\Functional;

use Drupal\Core\Url;

/**
 * Tests CiviCRM installation.
 *
 * @group drupal_civicrm
 */
class InstallTest extends CiviCrmTestBase {

  /**
   * Tests the installation in integrity.
   */
  public function testInstall() {
    $site_path = $this->kernel->getSitePath();
    $this->assertTrue(file_exists($site_path . '/civicrm.settings.php'), "The civicrm.settings.php file was found in $site_path");
    $this->assertTrue(function_exists('civicrm_api3'), 'civicrm_api() function exists.');

    $user = $this->createUser([
      'administer CiviCRM',
      'access CiviCRM',
      'access administration pages',
    ]);
    $this->drupalLogin($user);
    $this->drupalGet(Url::fromRoute('civicrm.admin_config_civicrm'));
    $this->assertSession()->titleEquals('CiviCRM | Drupal');
  }

}
