<?php

    /**
     * Checks if a given widget exists within a given sidebar
     * @param  string  $sidebarSlug  The slug of the sidebar to check in
     * @param  string  $widgetSearch The widget id to search for
     * @return boolean               Returns the widget instance or if nothing found return false
     */
    function has_welcome_text_widget() {
        global $post;
        $result = false;

        // Whete to look and what to look for
        $sidebarSlug = 'slider-area';
        $widgetSearch = 'text-';

        // Get all textwidgets on this page
        $widgetSlug = 'widget_' . $post->ID . '_text';
        $textWidgets = get_option($widgetSlug);

        // Get widgets that's inside the given sidebar
        $sidebars = wp_get_sidebars_widgets();
        $widgets = $sidebars[$sidebarSlug];

        // If there's no widgets inside the given sidebar return false
        if (count($widgets) == 0) return false;


        // Loop the widgets to find a match
        foreach ($widgets as $widget) {
            if (strpos($widget, $widgetSearch) > -1) {
                $result = $widget;
                break;
            }
        }

        $widgetIndex = preg_replace('/[^0-9.]+/', '', $result);
        $result = $textWidgets[$widgetIndex];

        return $result;
    }

    /**
     * Remove unwanted parent theme templates
     * @param  array $templates Loaded templates
     * @return array            New list of templates
     */
    function hbg_remove_page_templates($templates) {
        $to_disable = array(
            'templates/alarm-list-page.php',
            'templates/alarm-page.php',
            'templates/alarm-rss.php',
            'templates/event-list-page.php',
            'templates/start-page.php'
        );

        foreach($to_disable as $disable) {
            unset($templates[$disable]);
        }

        return $templates;
    }
    add_filter('theme_page_templates', 'hbg_remove_page_templates');