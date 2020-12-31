<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/Adwait2196
 * @since      1.0.0
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<!-- Form for saving custom settings -->

<h1>Books Menu</h1>
<form method="post" action="options.php">
  <?php settings_fields( 'books-setting-group' ); ?>
  <?php do_settings_sections( 'book_menu' ); ?>
  <?php submit_button(); ?>
</form>
