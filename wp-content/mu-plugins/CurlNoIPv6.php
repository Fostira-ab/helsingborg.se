<?php

/*
Plugin Name: cURL no IPv6
Plugin URI: https:
Description: On systems where cURL is compiled with IPv6, Requests to Wordpress Update API will timeout since cURL tries it about 15s. Since the timeout defined by WordPress is 3s/5s/10s this will breake the Updater. This Plugin simply forces cURL to use IPv4 only.
Author: GOLDERWEB – Jonathan Golder
Version: 1.0
Author URI: http://golderweb.de/
*/

/*
 * Copyright 2014 GOLDERWEB – Jonathan Golder <jonathan@golderweb.de>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

// Safety first
if (!defined('ABSPATH')) {
    die();
}

/**
 * Sets CURLOPT_IPRESOLVE to CURL_IPRESOLVE_V4 for cURL-Handle provided as parameter
 *
 * @param resource $handle A cURL handle returned by curl_init()
 * @return resource $handle A cURL handle returned by curl_init() with CURLOPT_IPRESOLVE set to CURL_IPRESOLVE_V4
 *
 */
function gwCurlSetoptIpresolve($handle)
{
    curl_setopt($handle, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    return $handle;
}

// Add function to hook 'http_api_curl' with priority 10 and expecting 1 parameter. 
if (function_exists('gwCurlSetoptIpresolve')) {
    add_action('http_api_curl', 'gwCurlSetoptIpresolve', 10, 1);
}
