<?php

/**
 * Plugin Name:       Hbg Widget Migrater
 * Plugin URI:
 * Description:
 * Version:           1.0.0
 * Author:            Kristoffer Svanmark
 * Author URI:
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       hbg-migrate
 * Domain Path:       /languages
 */

add_action('init', function () {

    // Migration process
    if (isset($_GET['migrate']) && $_GET['migrate'] === 'yes-please') {
        global $wpdbFrom;
        $wpdbFrom = new \wpdb(DB_USER, DB_PASSWORD, 'hbg_old', DB_HOST);

        // Include all migration scripts from the hbg-migrate folder
        foreach (glob(__DIR__ . '/hbg-migrate/*.php') as $migrate) {
            require_once $migrate;
        }

        new \HbgMigrate\MigrationEngine();

        exit;
    }

    // Check data strucutre for widget of type
    if (isset($_GET['view_widget_structure'])) {
        global $wpdbFrom;
        $wpdbFrom = new \wpdb(DB_USER, DB_PASSWORD, 'hbg_old', DB_HOST);

        require __DIR__ . '/hbg-migrate/MigrationEngine.php';
        $engine = new \HbgMigrate\MigrationEngine(false);
        wp_send_json($engine->getWidgetStructure($_GET['view_widget_structure']));
        exit;
    }

    // Check data strucutre for widget of type
    if (isset($_GET['view_widget_types'])) {
        global $wpdbFrom;
        $wpdbFrom = new \wpdb(DB_USER, DB_PASSWORD, 'hbg_old', DB_HOST);

        require __DIR__ . '/hbg-migrate/MigrationEngine.php';
        $engine = new \HbgMigrate\MigrationEngine(false);
        wp_send_json($engine->getWidgetTypes());
        exit;
    }
});
