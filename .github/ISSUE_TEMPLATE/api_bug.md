---
name: API Bug
about: "Report a bug you have encountered using SeAT API."
---

# Bug
*This template contains an example bug report. Please replace all text except for the checklist and the section headers (they start with \#). Thank you for your contribution to improving SeAT.*

*In this space, please provide a short description of the bug you've encountered.
This should help us to understood what you've did while you get the error. E.g.:*

When I'm sending a request to `/roles/affiliation/character` I got a success response but the user still not have the role attached to him.

*Side note: If you are using SeAT API programmatically, please attach a gist version or a link to your repository.*

## Expected

*Please provide a short description about what you were expecting in normal operation.*

The user A should get the role B.

## Request

### Method

`POST`

### Path

`/roles/affiliation/character`

### Headers

| Header Name  | Header Value     |
| ------------ | ---------------- |
| X-Token      | private-key      |
| Content-Type | application/json |
| Accept       | application/json |

### Body

```json
{
  "role_id": 18,
  "character_id": 90795931,
  "inverse": true
}
```

## Response

### Status Code

`200`

### Headers

| Header Name       | Header Value                  |
| ----------------- | ----------------------------- |
| Server            | nginx/1.13.9                  |
| Content-Type      | application/json              |
| Transfer-Encoding | chunked                       |
| Connection        | keep-alive                    |
| X-Powered-By      | PHP/7.1.15                    |
| Cache-Control     | no-cache, private             |
| Date              | Sun, 25 Nov 2018 21:37:17 GMT |

### Body

```
true
```

## Logs

*Please attach the content of the following files to your bugs report:*
 - *laravel-{date}.log (this file will contains all information regarding to error in code)*

*Those files can be found in the following directory: `/var/www/seat/storage/logs/`*
*For detailed instructions about how to retrieve them on either blade or Docker installation, please refer to the [documentation](https://eveseat.github.io/docs/troubleshooting/#checking-log-files)*

*In case you're not providing the complete file, please surround the content with three grave accent before and after the content (```)*

*Furthermore, ensure you're providing the full exception stack and not only the first or last line. Lines regarding an exception are numbered from 1 to infinite and preceded by two lines like:*
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

# Checklist

Check all boxes that apply to this issue:
 - [ ] Bug description is provided
 - [ ] Expected comportment is provided
 - [ ] Request Path is provided
 - [ ] Request Method is provided
 - [ ] Request Headers are provided
 - [ ] Request Body is provided (for `POST` and `PATCH` requests only)
 - [ ] Response Status is provided
 - [ ] Response Headers are provided
 - [ ] Response Body is provided
 - [ ] Laravel log is provided
