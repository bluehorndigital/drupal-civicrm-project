<?php

namespace Drupal\Tests\drupal_civicrm\Functional;

use Drupal\Component\Render\FormattableMarkup;
use Drupal\Core\Database\Database;
use Drupal\Tests\BrowserTestBase;

// @todo tests are failing due to civicrm.settings.php installing to sites/{site_id}/ not sites/simpletest/{site_id} (site.path is incoorrect.) \Civi\Setup\DrupalUtil::getDrupalSiteDir($cmsPath);
abstract class CiviCrmTestBase extends BrowserTestBase {

  protected $defaultTheme = 'classy';

  protected static $modules = [
    'civicrm',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    define('CIVICRM_CONTAINER_CACHE', 'never');
    define('CIVICRM_TEST', 1);
    parent::setUp();
  }

  protected function changeDatabasePrefix() {
    parent::changeDatabasePrefix();
    $connection_info = Database::getConnectionInfo('default');
    Database::addConnectionInfo('civicrm_test', 'default', $connection_info['default']);
    Database::addConnectionInfo('civicrm', 'default', $connection_info['default']);
  }

  public function installDrupal() {
    parent::installDrupal();

    // Check if the `civicrm.settings.php` file was placed correctly.
    // @todo remove after https://github.com/civicrm/civicrm-core/pull/18843
    // @see https://lab.civicrm.org/dev/core/-/issues/2140
    if (!file_exists($this->siteDirectory . '/civicrm.settings.php')) {
      $site_id = basename(\Drupal::service('site.path'));
      if (file_exists("sites/$site_id/civicrm.settings.php")) {
        rename("sites/$site_id/civicrm.settings.php", $this->siteDirectory . '/civicrm.settings.php');
      }
      else {
        $this->fail('Could not ensure civicrm.settings.php exists in its correct location.');
      }
    }
  }

}
