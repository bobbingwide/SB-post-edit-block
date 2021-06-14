=== Post Edit block ===
Contributors:      bobbingwide
Tags:              block, post-edit, Gutenberg, FSE
Tested up to:      5.7.2
Stable tag:        0.1.0
License:           GPLv3
License URI:       https://www.gnu.org/licenses/gpl-2.0.html

Post edit block to allow direct editing of the post

== Description ==

A single block plugin to display a link to edit the post.
The link is only displayed to logged in users.


== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/sb-post-edit-block` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress

== Screenshots ==
1. Post edit block and default settings

== Upgrade Notice ==
= 0.1.0 = 
Update for an improved version that's selectable.

= 0.0.0 =
First version to replace any `[post-edit]` shortcodes in FSE themes

== Changelog ==
= 0.1.0 = 
* Added: Add attributes and supports to block.json #1
* Added: Support Link text field and alignment in the editor #2
* Changed: Implement SSR rendering to match editor #2
* Tested: With WordPress 5.7.2 and WordPress Multi Site
* Tested: With Gutenberg 10.8.0
* Tested: With PHP 8.0

= 0.0.0 =
* Added: First version of the server side rendered block,[#1](https://github.com/bobbingwide/sb-post-edit-block/issues/1)
* Tested: With WordPress 5.7.1 and WordPress Multi Site
* Tested: With Gutenberg 10.6.0-rc.1
* Tested: With PHP 8.0