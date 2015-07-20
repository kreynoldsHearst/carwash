===  WP Find Your Nearest ===
Contributors: adamsargant
Donate link: http://www.sargant.net/projects/wordpress-plug-ins/
Tags: location, distance, find, finder, postcode, zipcode, locator, nearest
Requires at least: 3.0.0
Tested up to: 3.5
Stable tag: 0.2.5

"Find Your Nearest" creates a custom post type which can be associated with a latitude and longitude calculated from your local postal code, which can then be sorted by distance from a postal code entered into a search field.

== Description ==

Have you ever wanted the functionality to allow your visitors to search for their nearest... shop, drop in centre, you name it?

This plugin meets that need. You can create as many entries as you want, associate them with latitude and longitude using the Google Map API and allow your vistors to search for their nearest item by entering their own postal code.

This plugin has been well tested with UK postcodes and also tested with US zipcodes and AUS postal codes among others. All feedback welcome.

## Premium Version now available

The [WP 'Find Your Nearest' Premium](http://www.sargant.net/projects/wordpress-plug-ins/wp-find-your-nearest-premium/) plugin adds the following functionality to the popular WP Find Your Nearest plugin.

* Ability to use a hierarchical taxonomy (category), also included in url of searched for items, with a widget menu of category entries (ideal for sorting entries by region and subregion for example)
* Ability to apply non-hierarchical taxonomy (tags) and to restrict search to specific tags- suitable for differentiating between tem types (e.g if you were running a "Find Your Nearest Leisure Facility" site, you could distinguish between libraries, swimming pools, cinemas etc.)
* Ability to limit search by radius/distance from
* Shortcode to insert search form into post or page rather than only a widget
* Ability to add explanatory text to the top of the search results page
* Ability to use shortcodes within returned search results
* Support and lifetime upgrades

== Installation ==

1. Upload the folder wp-find-your-nearest to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Create a page that you will use to display your search results... Note: This page will not contain anything until a search is performed using the search form provided by the "FYN - Search Form" widget. It can contain other text that will be overwritten when landed on as a result of a Find Your Nearest search.
4. Visit the settings page under the Menu item "Find Your Nearest" and set the necessary options. The "Search Results Page" and "Country" settings are required for the plugin to work.
5. You can now create new "Find Your Nearest" items. Enter the postal code in the required field and click the "Update Latitude and Longitude" button to call the Google Maps API and place the latitude and longitude in the appropriate fields before saving the entry.
6. The plugin includes a widgets to enable searching. "FYN - Search Form" simply adds a search form to your sidebar.

== Screenshots ==

1. The settings page
2. The add new item page

== Changelog ==

= 0.2.5 =
* urgent bug fix to identify location correctly

= 0.2.4 =
* Fix bug that resulted in occasional false lat/long values being returned

= 0.2.3 =
* Updated Google API to V3

= 0.2.2 =
* Add information regarding premium version of plugin

= 0.2.1 =
* Fix bug that caused search to break if widget placed in header
* Fix bug that prevented results displaying different places with same postal code

= 0.2.0 =
* Included new option to limit search results
* Added Google map to search results displayed in modal dialog box
* Regional Categories navigation widget removed pending bugfix

= 0.1 =
* Launch

== Upgrade Notice ==

= 0.2.2 =
New Premium Version



