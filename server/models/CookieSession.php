<?php

ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', getenv('IS_DOCKER') ? 0 : 1);
ini_set('session.gc_maxlifetime', 3600 * 24 * 30);

class CookieSession {
    private $sessionPrefix = '';

    function __construct() {
        $this->initSession();
    }

    public function initSession() {
        session_set_cookie_params(3600 * 24 * 30);
        session_cache_limiter(false);
        session_start();
    }

    public function closeSession() {
        session_destroy();
    }

    public function clearSessionData() {
        $this->store('userId', null);
        $this->store('staff', null);
        $this->store('token', null);
        $this->store('ticketNumber', null);
    }

    public function setSessionData($data) {
        foreach($data as $key => $value)
            $this->store($key, $value);
    }

    public function createSession($userId, $staff = false, $ticketNumber = null) {
        session_regenerate_id();
        $this->store('userId', $userId);
        $this->store('staff', $staff);
        $this->store('ticketNumber', $ticketNumber);
        $this->store('token', Hashing::generateRandomToken());
    }

    public function isTicketSession() {
        return $this->getStoredData('ticketNumber') && $this->getStoredData('token');
    }

    public function getTicketNumber() {
        return $this->getStoredData('ticketNumber');
    }

    public function getUserId() {
        return $this->getStoredData('userId');
    }

    public function getToken() {
        return $this->getStoredData('token');
    }

    public function sessionExists() {
        return !!$this->getToken();
    }

    public function isStaffLogged() {
        return $this->getStoredData('staff');
    }

    public function checkAuthentication($data) {
        $userId = $this->getStoredData('userId');
        $token = $this->getStoredData('token');

        return $userId && $token &&
            $userId === $data['userId'] &&
            $token === $data['token'];
    }

    public function store($key, $value) {
        $_SESSION[$this->sessionPrefix . $key] = $value;
    }

    private function getStoredData($key) {
        $storedValue = null;

        if (array_key_exists($this->sessionPrefix . $key, $_SESSION)) {
            $storedValue = $_SESSION[$this->sessionPrefix . $key];
        }

        return $storedValue;
    }

    public function isLoggedWithId($userId) {
        return ($this->getStoredData('userId') === $userId);
    }

    public function setSessionPrefix($prefix) {
        $this->sessionPrefix = $prefix;
    }
}
