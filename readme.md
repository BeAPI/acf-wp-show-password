# ACF WP Show Password #

Very simple WordPress plugin to add a checkbox show password when it's an ACF input type password

1. Works both for ACF and WP or only WP
2. Won't break if ACF is not installed 
3. Add your field type password to your acf group field
4. That's it ! The login screen WP and field type password ACF will get show/hide checkbox :)

## How to install

1. Install and activate this plugin
2. Once installed it will add a checkbox and a link on login screen WP to show password (and reset field)
3. If ACF plugin is enabled it will add the functionality on field type password


## Override HTML markup

There's a WP filter for that but make sure you keep IDs and class for inputs. Otherwise js won't work.

## Screenshots

![Show login password](/assets/screenshots/login.png?raw=true)

![Show password](/assets/screenshots/demo1.png?raw=true)

## Requirements

* PHP 5.4

## Thanks ##

Thanks to Elliot Condon http://www.elliotcondon.com/ for creating Advanced Custom Fields.
