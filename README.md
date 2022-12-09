# Scandiweb_Cronhealth

This Magento 2 module schedules a cron job to send a HTTP GET request
to [healthchecks.io](https://healthchecks.io) monitoring service (or a similar service) every hour. When the cron jobs are not running per the expected schedule, healthchecks.io will send a notification to the store owner. It is then a good idea to check if other Magento cron jobs are running normally.

This monitoring setup will detect various failure scenarios, including:

* system's cron daemon is not running
* Magento cron job runner crashes on startup
* One of the Magento cron jobs runs longer than expected and blocks other jobs from running

## Installation

Run the following:

*Optional*, run only if "Core" module is not installed yet:
```
composer config repositories.module-core git https://github.com/scandiwebcom/Scandiweb-Assets-Core.git
composer require scandiweb/module-core:"dev-master as 0.1.2"
```

```
composer config repositories.module-menumanager git git@github.com:scandiwebcom/Cron-Health-Checker.git
composer require scandiweb/cronhealth:1.2.1
php -f bin/magento setup:upgrade
```

## Configuration

Stores->Configuration->Scandiweb->Cron health checks
If 'Enabled' is set to 'No', cron job will still be scheduled, it just will not do anything.

## Magento 1

Same module for Magento 1: https://github.com/janiscaunecm/Healthchecks_Magento/
