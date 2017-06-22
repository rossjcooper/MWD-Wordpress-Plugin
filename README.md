# MWD Wordpress Plugin

A starter plugin with all the boilerplate done for Vuejs and some useful PHP libraries.

## Features
* Full build process for single file `.vue` components setup ready to go.
* Full build process for `scss` files and within Vue components.
* Sourcemapping for `.scss` and soon for `.js/.vue` files.
* Super handy PHP libraries for those used to Laravel.
* Example class and admin screen to show Vue and Eloquent integrations.

## Installation

1. Clone or download the repo into you WordPress `wp-content/plugins` folder.
2. Run `composer install` to download all PHP libraries.
3. Run `npm install` to download all node modules.
4. Run `npm run dev` to build development version of scripts and styles.

## Usage
* Feel free to change the namespace in the `composer.json` file to fit your plugin.
* Check that the database is configured correctly in the `eloquent.php` file, it uses WordPress' `wp-config.php` by default.
* Run `npm run dev` or `npm run watch` to compile JS and SCSS files.
* Or run `npm run prod` for a production build.
* See `package.json` for all scripts available.

## Issues
This is a current work in progress so it may not be perfect, if you have any suggestions or problems open an issue in the tracker.
