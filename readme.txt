=== CoralCDN ===
Contributors: morganestes
Donate link: http://www.morganestes.me/donate/
Tags: CDN, content delivery network, speed, performance
Requires at least: 2.1.0
Tested up to: 3.9
Stable tag: 1.0.0
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

This plugin enables using the Coral Content Distribution Network to speed up your website.

== Description ==

Content Delivery/Distribution Networks help speed up a website by loading assets from multiple sources around the Internet. [CoralCDN](http://www.coralcdn.org/) provides a free network of servers to help website owners easily offload resources to improve the performance of the site.

This plugin automatically enables the network for images added to a post or page.

== Installation ==

1. Upload `coral-cdn.php` to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Upload images in your posts and pages just like always.

== Frequently Asked Questions ==

= How does this work? =

CoralCDN works by appending `.nyud.net` to any assets you want to speed up.
The plugin works by rewriting the site’s URL for any images you upload when editing a post.

= Can I use this for CSS/JS files? =

Not yet, but I'm working on that.

== Changelog ==

= 1.0.0 =
* Admin changes only. Code is same version as 0.1.1.
* Switched to [semver](http://semver.org) version numbering.

= 0.1.1 =
* Minor updates to make sure right URL is used.

= 0.1.0 =
* Initial release.
