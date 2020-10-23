<?php

namespace Drupal\Tests\drupal_civicrm\Functional;

use Drupal\Core\Database\Database;
use Drupal\Tests\BrowserTestBase;

// Requires patching for civicrm-core.
// @see https://github.com/civicrm/civicrm-core/pull/18843
// @see https://lab.civicrm.org/dev/core/-/issues/2140
abstract class CiviCrmTestBase extends BrowserTestBase {

  protected $defaultTheme = 'classy';

  protected static $modules = [
    'block',
    'civicrm',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    define('CIVICRM_CONTAINER_CACHE', 'never');
    define('CIVICRM_TEST', 1);
    parent::setUp();
    $this->drupalPlaceBlock('system_breadcrumb_block');
    $this->drupalPlaceBlock('page_title_block');
    $this->drupalPlaceBlock('local_tasks_block');
    $this->drupalPlaceBlock('local_actions_block');
  }

  protected function changeDatabasePrefix() {
    parent::changeDatabasePrefix();
    $connection_info = Database::getConnectionInfo('default');
    Database::addConnectionInfo('civicrm_test', 'default', $connection_info['default']);
    Database::addConnectionInfo('civicrm', 'default', $connection_info['default']);
  }

}
