<?php

include_once 'ExternalSession.php';
include_once 'CookieSession.php';

ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', getenv('IS_DOCKER') ? 0 : 1);
ini_set('session.gc_maxlifetime', 3600 * 24 * 30);

class Session {
    protected static $instance;

    private function __construct()
    {
    }

    private static function isExternalSession(): bool {
        return isset($_COOKIE['semaphore']);
    }

    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            if (self::isExternalSession()) {
                static::$instance = new ExternalSession();
            } else {
                static::$instance = new CookieSession();
            }
        }
        return static::$instance;
    }
}
