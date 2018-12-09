Changelog of SeAT

#2018-12-08
| Package Name   | Version       | 
|----------------|:--------------|
| [api](https://github.com/eveseat/api) | [3.0.5](https://packagist.org/packages/eveseat/api) |
| [eveapi](https://github.com/eveseat/eveapi) | [3.0.9](https://packagist.org/packages/eveseat/eveapi) 
| [notifications](https://github.com/eveseat/notifications) | [3.0.2](https://packagist.org/packages/eveseat/notifications) 
| [services](https://github.com/eveseat/services) | [3.0.4](https://packagist.org/packages/eveseat/services) 
| [web](https://github.com/eveseat/web) | [3.0.10](https://packagist.org/packages/eveseat/web) 

This update contains mostly of two things regarding table representation of data. For once most of the datatables has been moved to server-side datatables. This results in enabling SeAT to load a page more reliable and faster. Even huge sets of data do not cause server timeouts anymore. Previously around 2M asset items broke the representation of character assets, while now we have tested up to 5M of asset items render smoothly and fast. 
Other then that we introduced tabs to switch between the characters view and the character groups view. 

![Tabs](https://i.imgur.com/s3l4Hul.png)

Smaller improvements are the more reliable and quicker name resolver, which should prevent from views returning IDs instead of names and only linking to characters and corporations if registered to SeAT instance.

## New Features
* feat (corporation) Include main character into MemberTracking
* feat (corporation) Include main character into Corporation Mining Ledger
* feat (api) Add main_character_id to group-list 
* feat (resolver): Improve resolver using local database information
* feat (profile): Provide a link to characters
* feat (dependencies): Update DataTables Dependencies for new DataTable version
* feat (contacts): Move to asynchronous loading
* feat (assets): Move to asynchronous loading
* feat (core): Provide events when a role is attached or detached from a group
* feat (contracts): Move to asynchronous loading
* feat (core): Use new migration mechanic
* feat (core): Resolve ids universe names
* feat (users): Move to asynchronous loading 
* feat (killmails): Move to asynchronous loading
* feat (wallets): Move to asynchronous loading
* feat (mails): Move to asynchronous loading and show mails to be read in a pop up
* feat (transactions): Move to asynchronous loading
* feat (characters): Make the list sortable by name and turn into async
* feat (market): Update market tab and refactor partials
* feat (mails): Mailtimeline Improvement: only link existing characters and corporations

## Fix

* fix (characters) Avoid the group table from characters list to throw an exception on Admin user
* fix (mining ledger): Fix loading time issue due to prices eager-load
* fix (settings): Fix GA tracking explanation dead link
* fix (mining-ledger): fix ErrorException for undefined variable character_id
* fix (assets): Add missing EVE Logo