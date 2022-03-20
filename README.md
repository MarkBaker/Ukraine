Support Ukraine
==========

A PHP Composer Plug-in to show support for Ukraine

---

## Installation

Include this plug-in in the `composer.json` file for your own libraries:

```
    "require": {
        ...,
        "markbaker/ukraine": "*"
    },
```

Then add a `scripts` section to your `composer.json` to trigger the support banned when your libraries are installed or updated using `composer require`, `composer install` or `composer update`  

    "scripts": {
        "post-package-install": [
            "markbaker\\ukraine::postPackageInstall"
        ],
        "post-package-update": [
            "markbaker\\ukraine::postPackageUpdate"
        ]
    }

![The Truth doesn't drown in water, and it doesn't burn in fire!](./image.jpg "Support Ukraine" )