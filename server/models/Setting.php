<?php

class Setting extends DataStore {
    const TABLE = 'setting';

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

    public function getValue($params = null) {

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
