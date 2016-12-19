![SeAT](http://i.imgur.com/aPPOxSK.png)

<h2 align="center">
SeAT: A Simple, EVE Online API Tool and Corporation Manager

<br>

<a href="https://packagist.org/packages/eveseat/seat"><img src="https://poser.pugx.org/eveseat/seat/v/stable" /></a>
<a href="https://packagist.org/packages/eveseat/seat"><img src="https://poser.pugx.org/eveseat/seat/v/unstable" /></a>
<a href="https://packagist.org/packages/eveseat/seat"><img src="https://poser.pugx.org/eveseat/seat/license" /></a>
<a href="http://seat-docs.readthedocs.org/en/latest/"><img src="https://readthedocs.org/projects/seat-docs/badge/?version=latest" /></a>
<a href="https://eveseat-slack.herokuapp.com/"><img src="https://eveseat-slack.herokuapp.com/badge.svg" /></a>

</h2>

SeAT is a simple, [EVE Online](https://www.eveonline.com/) Corporation and API management tool, built using [Laravel](https://laravel.com/). SeAT allows you to keep an eye on all things related to your corporation; from wallets, to mail, to assets for both characters and corporations. Notifications can be sent based on starbase fuel levels and a fully featured role based access control system allows you to tightly control who has access to what. This repository contains the main SeAT Repository. It can be seen as the 'glue' for all of the SeAT core packages.

## screenshots
![character view](https://i.imgur.com/hxfcYll.png)
![starbase view](https://i.imgur.com/qFX2lDS.png)

## demo
It is possible to have a free (2 hour limit) demo of SeAT using [https://dply.co](https://dply.co/b/hN6lzMWo). All you need is a valid [Github](github.com) account with an SSH key.

To start a demo, simply click the **dply** button below, signing with your [Github](github.com) account and give the server a name. Then, just hit *Create Server*.

[![Dply](https://dply.co/b.svg)](https://dply.co/b/hN6lzMWo)

Setup can take a few minutes. Check the logfile at `/var/log/cloud-init-output.log` for when it says *[OK] Installation complete!*, then reset the admin password using `php /var/www/seat/artisan seat:admin:reset` and browse to the IP of your server!

## packages
For the **actual** SeAT source, please refer to the following package repositories:  

| Package Name   | Version       | Downloads | Code Climate |
|----------------|:--------------|:----------|:-------------|
| [api](https://github.com/eveseat/api) | [![Latest Stable Version](https://poser.pugx.org/eveseat/api/v/stable)](https://packagist.org/packages/eveseat/api) | [![Total Downloads](https://poser.pugx.org/eveseat/api/downloads)](https://packagist.org/packages/eveseat/api) | [![Code Climate](https://codeclimate.com/github/eveseat/api/badges/gpa.svg)](https://codeclimate.com/github/eveseat/api) |
| [console](https://github.com/eveseat/console) | [![Latest Stable Version](https://poser.pugx.org/eveseat/console/v/stable)](https://packagist.org/packages/eveseat/console) | [![Total Downloads](https://poser.pugx.org/eveseat/console/downloads)](https://packagist.org/packages/eveseat/console) | [![Code Climate](https://codeclimate.com/github/eveseat/console/badges/gpa.svg)](https://codeclimate.com/github/eveseat/console) |
| [installer](https://github.com/eveseat/installer) | n/a | n/a | [![Code Climate](https://codeclimate.com/github/eveseat/installer/badges/gpa.svg)](https://codeclimate.com/github/eveseat/installer) |
| [eveapi](https://github.com/eveseat/eveapi) | [![Latest Stable Version](https://poser.pugx.org/eveseat/eveapi/v/stable)](https://packagist.org/packages/eveseat/eveapi) | [![Total Downloads](https://poser.pugx.org/eveseat/eveapi/downloads)](https://packagist.org/packages/eveseat/eveapi) | [![Code Climate](https://codeclimate.com/github/eveseat/eveapi/badges/gpa.svg)](https://codeclimate.com/github/eveseat/eveapi) |
| [notifications](https://github.com/eveseat/notifications) | [![Latest Stable Version](https://poser.pugx.org/eveseat/notifications/v/stable)](https://packagist.org/packages/eveseat/notifications) | [![Total Downloads](https://poser.pugx.org/eveseat/notifications/downloads)](https://packagist.org/packages/eveseat/notifications) | [![Code Climate](https://codeclimate.com/github/eveseat/notifications/badges/gpa.svg)](https://codeclimate.com/github/eveseat/notifications) |
| [services](https://github.com/eveseat/services) | [![Latest Stable Version](https://poser.pugx.org/eveseat/services/v/stable)](https://packagist.org/packages/eveseat/services) | [![Total Downloads](https://poser.pugx.org/eveseat/services/downloads)](https://packagist.org/packages/eveseat/services) | [![Code Climate](https://codeclimate.com/github/eveseat/services/badges/gpa.svg)](https://codeclimate.com/github/eveseat/services) |
| [web](https://github.com/eveseat/web) | [![Latest Stable Version](https://poser.pugx.org/eveseat/web/v/stable)](https://packagist.org/packages/eveseat/web) | [![Total Downloads](https://poser.pugx.org/eveseat/web/downloads)](https://packagist.org/packages/eveseat/web) | [![Code Climate](https://codeclimate.com/github/eveseat/web/badges/gpa.svg)](https://codeclimate.com/github/eveseat/web) |

## documentation & installation
Please refer to the [documentation](http://seat-docs.rtfd.org) for installation instructions, upgrade guides and more.

## security
If you find any security vulnerabilities within SeAT, please send an email to theninjabag@gmail.com to address instead of creating a public Github issue.

## donate
If you like SeAT, please consider donating ISK in game to [qu1ckkkk](https://gate.eveonline.com/Profile/qu1ckkkk).
