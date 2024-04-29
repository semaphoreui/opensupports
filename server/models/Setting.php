<?php

class Setting extends DataStore {
    const TABLE = 'setting';

    public static function getUrl($params) {
        $url = Setting::getSetting('url')->getValue();

        foreach ($params as $key => $value) {
            $pattern = "/\{\{\s*$key\s*}}/";
            $url = preg_replace($pattern, $value, $url);
        }

        return $url;
    }

    public static function getSetting($name) {
        return parent::getDataStore($name, 'name');
    }

    public static function getProps() {
        return array(
            'name',
            'value',
            'permission'
        );
    }

    public function getValue($params) {

        $value = $this->value;

        if (!isset($params)) {
            return $value;
        }

        foreach ($params as $k => $v) {
            $pattern = "/\{\{\s*$k\s*}}/";
            $value = preg_replace($pattern, $v, $value);
        }

        return $value;
    }
}
