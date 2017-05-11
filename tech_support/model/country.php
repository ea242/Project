<?php
class Country {
    private $countryCode, $countryName;

    public function __construct($countryCode, $countryName) {
        $this->countryCode = $countryCode;
        $this->countryName = $countryName;
    }

    public function getCountryCode() {
        return $this->countryCode;
    }

    public function setCountryCode($value) {
        $this->countryCode = $value;
    }

    public function getCountryName() {
        return $this->countryName;
    }

    public function setCountryName($value) {
        $this->countryName = $value;
    }



}
?>