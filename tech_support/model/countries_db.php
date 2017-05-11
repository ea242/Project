<?php
class CountriesDB {
    function get_countries() {
        $db = Database::getDB();
        $query = "SELECT * FROM countries";

        $result = $db->query($query);
        $countries = array();
        foreach ($result as $row) {
            $country = new Country($row['countryCode'],
                                   $row['countryName']);
            $countries[] = $country;
        }
        Database::closeDB();
        return $countries;
    }

}
?>