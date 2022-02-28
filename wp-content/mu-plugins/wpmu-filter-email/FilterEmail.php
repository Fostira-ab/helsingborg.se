<?php
/*
Plugin Name: Email Sender
Description: Plugin to configure email sender settings
Version: 0.1.0
Author: Erik Granström
*/

namespace MunicipioMu;

class FilterEmail
{
    const DEFAULT_MAIL_FROM_USERNAME = 'no-reply';

    public function __construct()
    {
        add_action('init', [$this, 'init']);
    }

    public function init()
    {
        add_filter('wp_mail_from', [$this, 'filterMailFrom'], 5);
        add_filter('wp_mail_from_name', [$this, 'filterMailFromName'], 5);
    }

    public function filterMailFrom($original)
    {
        return explode('@', $original)[0] === 'no-reply' ? $this->getMailFromEmail() : $original;
    }

    public function filterMailFromName($original)
    {
        return $original === 'WordPress' ? $this->getMailFromName() : $original;
    }

    public function getSiteDomain()
    {
        return preg_replace('/www\./i', '', parse_url(get_home_url())['host']);
    }

    public function getMailFromUsername()
    {
        return defined('MUNICIPIO_MAIL_FROM_USERNAME') && !empty(MUNICIPIO_MAIL_FROM_USERNAME) ? MUNICIPIO_MAIL_FROM_USERNAME : self::DEFAULT_MAIL_FROM_USERNAME;
    }

    public function getMailFromDomain()
    {
        return defined('MUNICIPIO_MAIL_FROM_DOMAIN') && !empty(MUNICIPIO_MAIL_FROM_DOMAIN) ? MUNICIPIO_MAIL_FROM_DOMAIN : $this->getSiteDomain();
    }

    public function getMailFromName()
    {
        return defined('MUNICIPIO_MAIL_FROM_NAME') && !empty(MUNICIPIO_MAIL_FROM_NAME) ? MUNICIPIO_MAIL_FROM_NAME : get_bloginfo('name');
    }

    public function getMailFromEmail()
    {
        return $this->getMailFromUsername() . '@' . $this->getMailFromDomain();
    }
}

new FilterEmail();
