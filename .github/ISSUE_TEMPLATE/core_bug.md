---
name: Core Bug
about: "Report a bug you have encountered using SeAT. Are considered as bugs everything including ACL outage, Exception, etc... **Note:** Issues related to SeAT API must be reported on the API Issue template. If you're encountering issues while attempting to install SeAT itself, please go to our Slack in #support channel which will be a better place to sort such problems: [Get an invite](https://eveseat-slack.herokuapp.com). **IMPORTANT**: If you found a security outage, please relay it to [theninjabag@gmail.com](mailto:theninjabag@gmail.com)"
---

# Bug
*This template contains an example bug report. Please replace all text except for the checklist and the section headers (they start with \#). Thank you for your contribution to improving SeAT.*

*In this space, please provide a short description of the bug you've encountered.
This should help us to understood what you've did while you get the error. E.g.:*

When I'm going on the character list, I'm getting a popup with the following message:
```
DatatTables warning:
table id=character-list - Ajax Error.
For more information about this error, please see http://datatables.net/tn/7
```

## Expected

*Please provide a short description about what you were expecting in normal operation.*

I should get a list of all registered characters with their name, corporation, alliance and security status.

## Logs

*Please attach the content of the following files to your bugs report:*
 - *laravel-{date}.log (this file will contains all information regarding to error in code)*
 - *eseye-{date}.log (this file will contains all information regarding eseye endpoint, methods and attached HTTP response code)*

*Those files can be found in the following directory: `/var/www/seat/storage/logs/`*
*(for detailed instructions about how to retrieve them on either blade or Docker installation, please refer to the [documentation](https://eveseat.github.io/docs/troubleshooting/#checking-log-files))*

*In case you're not providing the complete file, please surround the content with three grave accent before and after the content (```)*

*Furthermore, ensure you're providing the full exception stack and not only the first or last line. Lines regarding an exception are numbered from 1 to infinite and preceded by two lines like :*
```
Some\Weired\Thing\StuffException in /path/to/the/file.php:14
Stack trace:
```

*Here is a sample of Exception with the attached trace.*
```
[2018-11-18 14:41:36] production.ERROR: Class 'PHPExcel_Shared_Font' not found {"exception":"[object] (Symfony\\Component\\Debug\\Exception\\FatalThrowableError(code: 0): Class 'PHPExcel_Shared_Font' not found at /var/www/seat/config/excel.php:182)
[stacktrace]
#0 /var/www/seat/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/LoadConfiguration.php(71): require()
#1 /var/www/seat/vendor/laravel/framework/src/Illuminate/Foundation/Bootstrap/LoadConfiguration.php(39): Illuminate\\Foundation\\Bootstrap\\LoadConfiguration->loadConfigurationFiles(Object(Illuminate\\Foundation\\Application), Object(Illuminate\\Config\\Repository))
#2 /var/www/seat/vendor/laravel/framework/src/Illuminate/Foundation/Application.php(213): Illuminate\\Foundation\\Bootstrap\\LoadConfiguration->bootstrap(Object(Illuminate\\Foundation\\Application))
#3 /var/www/seat/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php(162): Illuminate\\Foundation\\Application->bootstrapWith(Array)
#4 /var/www/seat/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php(146): Illuminate\\Foundation\\Http\\Kernel->bootstrap()
#5 /var/www/seat/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php(116): Illuminate\\Foundation\\Http\\Kernel->sendRequestThroughRouter(Object(Illuminate\\Http\\Request))
#6 /var/www/seat/public/index.php(54): Illuminate\\Foundation\\Http\\Kernel->handle(Object(Illuminate\\Http\\Request))
#7 {main}
"}
```

## Packages

*Please provide the version attached to each core package. In case you're running some extra plugin, complete the list accordingly. Those information can be retrieve in the `Settings > SeAT Settings` page or using `php artisan:seat:diagnose` (for more information about how to run the diagnose command, please refer to the [ocumentation](https://eveseat.github.io/docs/troubleshooting/#diagnose-command))*
 - **eveseat/seat**
 - **eveseat/api**
 - **eveseat/console**
 - **eveseat/eseye**
 - **eveseat/eveapi**
 - **eveseat/notifications**
 - **eveseat/services**
 - **eveseat/web**

## Hardware

*Please complete the list bellow regarding your server specification*
 - **RAM** 2Gb
 - **CPU Core** 2

## Software

*Please complete the list bellow regarding your installation*
 - **PHP** 7.2.3
 - **HTTP Web Service** Nginx 1.3.1
 - **Database Service** MySQL 5.6.9
 - **Operating System** Debian 9.0
 - **Using Docker** yes

# Checklist

Check all boxes that apply to this issue:
 - [ ] Bug description is provided
 - [ ] Expected comportment is provided
 - [ ] Laravel log is provided
 - [ ] Eseye log is provided
 - [ ] Package versions are provided
 - [ ] Server specification are provided