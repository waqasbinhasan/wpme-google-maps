=== WPME Google Maps ===
Author URI: http://wpmadeasy.com
Plugin URI: https://wordpress.org/plugins/wpme-google-maps/
Contributors: wpmadeasy
Donate link: http://wpmadeasy.com/google-maps
Tags: Google Maps, Google Map, Multiple Locations, Custom Markers, Short Code, gmaps, Wordpress Made Easy, WPMadeasy, WPME
Requires at least: 3.5
Tested up to: 4.9
Stable Tag: 2.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Plot multiple addresses on a Google Map, with easy to use interface and simple short code.

== Description ==

<h4>What's New in 2.2</h4>

* Added support for Google Maps API Key, which is now required by all Google APIs
* New option in plugin settings page to add your own Google Maps API Key
* Some performance improvements with respect to WordPress 4.5.3

WPME Google Maps adds Google Maps feature to your website. The simple yet intuitive interface allows to insert a map anywhere on your post or page, in less than a minute.

The powerful short code offers 2 modes to place a map directly - Basic and Advanced.

This is as simple as:

[wpme-gmap address="123 ABC Building, Street 99, Sydney - 12345, Australia"] (Basic Mode)

[wpme-gmap map="99"] (Advanced Mode)

<h4>Basic Mode</h4>

* Add a map by adding attributes directly to the short code
* Useful when you want to use a map at a single place only
* Supports single location
* Uses address as a content for marker's info popup
* Supports all attributes and highly customizable via easy to use GUI

<h4>Advanced Mode</h4>

* Create and save several maps short codes
* Supports multiple locations
* Supports custom marker for each location
* Supports custom content for each marker's info popup
* Just pass the Map ID using 'map' attribute to the short code
* No more mess of several attributes
* Edit a map or locations anytime from your Dashboard

<h4>WPME Google Maps Features</h4>

* Multiple Locations on a Map
* Custom Marker for Each Location
* Clickable Markers to Show Attached Content
* Custom Content for Each Marker's Info Popup
* Full Street Address (address)
* Width of Map, %age or px (width)
* Height of Map, %age or px (height)
* Marker Image (marker), select from available markers supplied by the plugin or use your own
* Zoom Level (zoom)
* Map Type, ROADMAP, SATELLITE, HYBRID or TERRAIN (type)
* Scroll Wheel Support, enable/disable (swheel)
* Map Controls, show/hide (controls)
* Cache Control, enable/disable (cache)
* Map CSS Class (class)
* Map CSS ID (id)

== Installation ==

1. Download plugin zip file to your computer and extract in a folder
1. Upload `wpme-google-maps` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Does WPME Google Maps require a Google Maps API Key? =

Yes, all of Google APIs now require an API Key. You can set your own key under 'WPME Google Maps' -> Settings (page) -> Settings (tab) -> 'Google Maps API Key' input option.

== Screenshots ==

1. Easily add Google Map anywhere
2. Easy to use user interface, so you don't need to remember all attributes
3. Simple short code, you can use without UI also

== Changelog ==

= 2.2 =
* Added support for Google Maps API Key, which is now required by all Google APIs
* New option in plugin settings page to add your own Google Maps API Key
* Some performance improvements with respect to WordPress 4.5.3

= 2.1 =
* Compatibility and performance improvements related to WordPress 4.5

= 2.0 =
* Major update
* Added support for multiple locations
* Added support for clickable markers with InfoWindow
* Added support for custom marker for each location
* Save Maps and Locations
* Added new attribute 'map' to render a saved map using Map's Post ID
* New pages added to Plugin's Admin Menu for Maps and Locations Management
* Previous settings and help page renamed as "Settings" and moved under 'WPME Google Maps' admin menu
* Several code improvements
* Several performance improvements

= 1.1 =
* Added 10 new markers
* Built-in pages for plugin Settings, Help and Support
* Dedicated menu option for plugin, in Word Press Admin left side menu
* Settings Page: Control plugin icon's visibility
* Help Page: Quick reference short code usage and attributes, and link to online User's Guide
* Support Page: Links to plugin support, questions, change log and previous versions
* Some performance improvements

= 1.0.1 =
* add_query_arg() vulnerability fix for potential XSS attack vectors
* Compatibility testing up to Word Press 4.2

= 1.0 =
* First release

== Upgrade Notice ==

= 2.2 =
Important update regarding Google Maps API Key - must upgrade to make the maps work correctly.

= 2.1 =
Compatibility and performance improvements related to WordPress 4.5

= 2.0 =
Major update, please upgrade.

= 1.0 =
This is the first release and does not require an upgrade.
