bbpress_merge_user
=================================

This WordPress plugin bulk merges imported users from bbPress to their equivalent WordPress user using the email address.  The imported bbPress user is deleted and all content is reassigned to the WordPress user with the same email address.

=== Merge bbPress User ===

Contributors: honeysilvas
Donate link: http://silverhoneymedia.com
Tags: bbPress, merge, user, import, bulk
Requires at least: 4.0
Tested up to: 4.7.1
Stable tag: 0.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


== Description ==
This WordPress plugin bulk merges imported users from bbPress to their equivalent WordPress user using the email address.

Make sure you have a backup of your database so you can rollback in case of any discrepancies or errors.

The import process might take a while if you have a lot of users to merge so please be patient!


== Installation ==

1. First, make sure you have a backup of your database so you can rollback in case of any discrepancies or errors.
2. Upload the entire 'shm_merge_bbpress_user' folder to the '/wp-content/plugins/' directory of your WordPress installation.
3. Activate the plugin through the 'Plugins' menu in WordPress
4. In your Dashboard, click "Merge bbPress Users".  This will start the import process.  This might take a while if you have a lot of users to merge so please be patient!
5. Scroll down to check the list of non-merged users (in case of errors).
6. That's it!
