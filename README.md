# Scandiweb_Cronhealth

The sole purpose of this module is to schedule a cron job every hour to send a GET request
to a Healthchecks.io (or any other) URL so that store owner gets notified when cron jobs
are not running per expected schedule anymore.

The idea is simple: if this cron job does not run, it is a good indicator to check if any Magento cron job runs.

## Installation

Run the following:

*Optional*, run only if "Core" module is not installed yet:
```
composer config repositories.module-core git https://github.com/scandiwebcom/Scandiweb-Assets-Core.git
composer require scandiweb/module-core:"dev-master as 0.1.2"
```

```
composer config repositories.module-menumanager git git@github.com:scandiwebcom/Cron-Health-Checker.git
composer require scandiweb/cronhealth:1.0.0
php -f bin/magento setup:upgrade
```

## Configuration

Stores->Configuration->Scandiweb->Cron health checks
If 'Enabled' is set to 'No', cron job will still be scheduled, it just will not do anything.


