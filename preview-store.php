<?php

/*
 Plugin Name: Preview Store
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Plugin to store preview of a video
Version: 1.0
Author: ashfaq
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

include 'libs/preview-store.php';

add_action('plugins_loaded', array( 'PreviewStore', 'getInstance' ));