<?php

// Various clean up functions
require_once('library/cleanup.php');

// Required for Foundation to work properly
require_once('library/foundation.php');

// Register all navigation menus
require_once('library/navigation.php');

// Add menu walker
require_once('library/menu-walker.php');

// Add menu walker
require_once('library/sidebar-menu-walker.php');

// Create widget areas in sidebar and footer
require_once('library/widget-areas.php');

// Return entry meta information for posts
require_once('library/entry-meta.php');

// Enqueue scripts
require_once('library/enqueue-scripts.php');

// Add theme support
require_once('library/theme-support.php');

// Add Helsingborg specific functions
require_once('library/helsingborg.php');

// Add scheduled tasks
require_once('library/scheduled-tasks.php');

// Add happy event functions
require_once('library/happy-event.php');

// Add Helsingborg AJAX functions
require_once('library/helsingborg-ajax.php');

// Add custom meta-functions
require_once('meta_boxes/meta-functions.php');


if (isset($_GET['dist']) && $_GET['dist'] == 'debug') {
    require_once('library/scheduled-tasks/scheduled_alarms_disturbance.php');
    $hbgDistrubance = new HbgScheduledAlarmsDisturbance();
    $hbgDistrubance->createAlarmPages();
}

?>
