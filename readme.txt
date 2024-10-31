=== Plugin Name ===
Contributors: avenger339, Everyblock
Tags: widgets, everyblock, widget, philly, pets
Tested up to: 3.6.1
Requires at least: 3.6.1
Stable tag: 2.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add a Philly Pet Widget Powered by Everyblock to a post or page.  Will also allow you to add as a widget.

== Description ==

Add a Philly Pet Widget Powered by Everyblock to a post or page.  Will also allow you to add as a widget.

== Installation ==

1. Add the folder to wp-content/plugins.
2. On the plugins page in the dashboard, click the "Activate" button under "Philly Pet Widget Powered by Everyblock".
3. On the dashboard, hover over "Plugins", and click on "Everyblock API Key".
4. Enter in your Everyblock API Key and press "Update API Key".
5. If you want to embed in a post, use the shortcode [display_philly_pets_widget].  This will add a 300x500 widget.  You can specify sizes by adding the attributes width and height (example: [display_philly_pets_widget width=400 height=600]).
6. If you want to add as a widget, drag the widget labeled "Philly Pets Widget" to the appropriate location.  You can change the height or width.

== Screenshots ==
1. The pet widget added to a page.

== Frequently Asked Questions ==

= Why are no entries or neighborhoods loading in my widget? =

First, make sure you set an API Key in Plugins -> Everyblock API Key.  Second, make sure the API Key is valid.  If it is still not working, please check the current running status of the Everyblock API.

= How do I add the pets widget to a post or page? =

After activating the plugin, add the shortcode [display_philly_pets_widget] to any page or post.  

= How do I change the width and height of the widget while it is embedded in a page or post? =

Add the shortcode attributes width and height.  Example: [display_philly_pets_widget width=400 height=600].

= How do I add the philly pets widget to a sidebar, header, or footer? =

After activating the plugin, go to Appearance -> Settings, and drag the "Philly Pets Widget" to the appropriate area. 

== Changelog ==

= 1.0 =
* First release.