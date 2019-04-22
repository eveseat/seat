# ToC

- [Code of conduct](#code_of_conduct)
- [Community contributions](#community_contributions)
- [Core contributions](#core_contributions)
    - [Classification](#classification)
    - [Bugs tracking](#bugs-tracking)
    - [Coding and norming conventions](#coding_and_norming_conventions)
        - [PHP Style](#php_style)
        - [HTML, Blade, Javascript and JSON Style](#html_blade_javascript_and_json_style)
        - [Commits convention](#commits_convention)
    - [Pull requests](#pull_requests)
        - [General](#general)
        - [Reviewing Flow](#reviewing_flow)

# Code of conduct

We as an open source community, got a point of honor to respect the work of eachother.

By contributing directly or indirectly to this project or any related project, you admit that other contributors are acting on their own free time.

Therefore, we will take any required actions to ensure the upper {PUT ANY MEANING WORD TO DESCRIBE UPPER CONTEXT}.

Our code of conduct is applying on every single platform the project is involving including but not limited to [GitHub](https://github.com/eveseat), [Slack](https://eve-seat.slack.com) and the [Eve Online Forum](https://forums.eveonline.com/t/seat-3-0-is-here).

You'll find details regarding the code of conduct [here](https://github.com/eveseat/seat/blob/master/CODE_OF_CONDUCT.md)

# Community contributions

SeAT community is mainly grouped into our [Slack team](https://eve-seat.slack.com) which is a formidable communication tool.

 - Use `#development` for any coding question or discussion related to **SeAT**
 - Use `#general` for general discussion
 - Use `#support` for any question regarding **SeAT** installation or troubles
 - Use `#plugins` for third party discussion arround SeAT, including plugins support

# Core contributions

## Classification

In order to keep both issues reporting and pull requests more accessible, we're using labels as described bellow :

| name | description |
| ---- | ----------- |
| esi | related to ESI update or fix |
| bug | related to reported and confirmed bug |
| fix | related to bug fixing |
| perf | related to performance improvement |
| enhancement | related to new feature or improved existing content |
| help wanted | related to question regarding support |
| wontfix | related to requests which will not be addressed in core |
| waiting feedback | indicate either an issue, request or pull request which is waiting feedback from its author |

## Bugs tracking

If you find a bug, please go on our [bugs trackers](https://github.com/eveseat/seat/issues) and open a new issue after having check it's not already reported. Otherwise, fill free to provide any extra information regarding known bug.

While opening an issue, ensure you're giving it a clear and suitable title.
Also please, meet our report template - there is normally one for feature request and one for bug report.

They both contains minimum required information to assist us in bug tracking or feature implementation. Keeping them uniformised is make them easier to read too.

**DISCLAIMER REGARDING SECURITY VULNERAIBILITY**
If you found (or think have found) a bug which is related to security vulnerability, please **DO NOT** open an issue or communicate about it. Instead, send any relevant information to [theninjabag@gmail.com](mailto:theninjabag@gmail.com).

## Coding and norming conventions

In case you're using Phpstorm IDE, you can pick our formatting stylesheet from [the resources repository](https://github.com/eveseat/resources/blob/master/SeAT-CodeStyle.xml).

You also can install the [Git Commit Template](https://plugins.jetbrains.com/plugin/9861-git-commit-template) which will help you to keep proper commits messages.

### PHP Style

- code have to be indented by 4 spaces
- code must meet [PSR-4 naming convention](https://www.php-fig.org/psr/psr-4).
- array must be declared using bracket instead of `array` keyword, even if the declared array is empty
- array key/value pairs must be aligned
- you have to put a blank line before any `return` statement
- both boolean `true`/`false` and `null` reference must use lowercase syntax
- any function must include at least a valid documentation block before its declaration meeting PHPDoc syntax
- any body of a function must contain a blank line at its own beginning

### HTML, Blade, Javascript and JSON Style

- code must be indented by 2 spaces

### Commits convention

The project is meeting [conventional commits](https://www.conventionalcommits.org) convention in order to store commits.
Its syntax is ensuring to get formal, uniform and easy to search commits database.

Try to use `<scope>` if possible as they're helping to groupped commits together. As this document is written, we're using the following scopes but not restricted to :

| scope | purpose |
| --- | -------------------- |
| acl | content related to access control layer / permissions |
| lang | content regarding translation |
| core | content related to release or documentation (ie: version change) |
| *character tabs* | content related to character views like assets, wallet or mining where the tab name is the used scope |
| *corporation tabs* | content related to corporation views like assets, wallet or mining where the tab name is the used scope |

If you're sending a pull request with commits, do your best to respect it.

Finally, if you're commit is adressing a bug, ensure you're closing the commit message using `Closes eveseat/seat#ISSUE_ID`. This will be recognize by GitHub and automatically link the commit together with the issue.

Any single pull request merge will be done using `squash and merge` function in order to keep commits history as readable as possible. Commit message could be altered in order to best match with the altered content.

## Pull requests

The project got a warm welcome to any pull requests. They can targetting bug fix, core improvement, user improvement or any other needed scope.

### General

Please avoid to address multiple content (fix, feature, etc...) into the same pull request as it makes them harder to review and merge into core - especially if there is some discussion regarding on part of the pull request. In one word, beeing granular is the key of the success ;)

By opening a pull requests, you accept that a discussion is started arround it in order to return some feedback and exchange with the community regarding the changes. You also accept it's not merged in 2 hours, 2 weeks or 2 month as we've got a job and assume IRL first.

### Reviewing Flow

We're generally working on a process which is including two reviewers.
This mean, once you've opened your pull request, two member have to review it and approve it before it's beeing merged into core.

However, some pull requests can defer to this rule and are mergeable with only one review. Those include :
 - ESI endpoint update
 - New migrations scripts (changed type, addind indexes, fixing column name or so)
 - Code commenting or typo mistakes
 - ORM relationship update
 - Configuration update

Regards,
SeAT Team
