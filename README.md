# Drupal CiviCRM [![Actions Status](https://github.com/bluehorndigital/drupal-civicrm-project/workflows/Build/badge.svg)](https://github.com/bluehorndigital/drupal-civicrm-project/actions)

This is a Composer template for setting up a Drupal and CiviCRM project.

## Use this template

You can create new Drupal + CiviCRM projects with the template:

```
composer create-project bluehorndigital/drupal-civicrm-project mysite
cd mysite
ddev start
```

## Local development

Looking to develop locally and contribute to CiviCRM Drupal modules? Check out these sections!

### Running tests

You can run the tests inside of DDEV

```
cp .ddev/example.docker-compose.testing.yaml .ddev/docker-compose.testing.yaml
ddev start
ddev phpunit web/modules/custom
```
