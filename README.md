# Drupal CiviCRM

This is a Composer template for setting up a Drupal and CiviCRM project.

## Local development

Looking to develop locally and contribute to CiviCRM Drupal modules? Check out these sections!

### Running tests

You can run the tests inside of DDEV

```
cp .ddev/example.docker-compose.testing.yaml .ddev/docker-compose.testing.yaml
ddev start
ddev phpunit web/modules/custom
```
