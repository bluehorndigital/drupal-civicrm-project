<?php

/**
 * @file
 * Enables modules and site configuration for a standard site installation.
 */

use Drupal\contact\Entity\ContactForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * Implements hook_form_FORM_ID_alter() for install_configure_form().
 *
 * Allows the profile to alter the site configuration form.
 */
function drupal_civicrm_form_install_configure_form_alter(&$form, FormStateInterface $form_state) {
  $form['#submit'][] = 'drupal_civicrm_form_install_configure_submit';
}

/**
 * Submission handler to sync the contact.form.feedback recipient.
 */
function drupal_civicrm_form_install_configure_submit($form, FormStateInterface $form_state) {
  $site_mail = $form_state->getValue('site_mail');
  ContactForm::load('feedback')->setRecipients([$site_mail])->trustData()->save();
}

/**
 * Implements hook_install_tasks().
 */
function drupal_civicrm_install_tasks(array $install_state) {
  return [
    'drupal_civicrm_install_civicrm' => [
      'display_name' => new TranslatableMarkup('Install CiviCRM modules'),
    ],
  ];
}

/**
 * Installation task to install CiviCRM modules
 *
 * This runs in its own task due to civicrm_install invoking \Civi\Setup::init()
 * before the database connection is defined.
 *
 * @todo open an issue for CiviCRM D8
 * @see install_profile_modules().
 */
function drupal_civicrm_install_civicrm(array &$install_state) {
  $modules = [
    'civicrm',
    'civicrmtheme',
    'webform_civicrm',
    'civicrm_entity',
  ];
  \Drupal::state()->set('install_profile_modules', $modules);
  return install_profile_modules($install_state);
}
