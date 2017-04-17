<?php
class TechnicianDB {

    function get_technicians() {
        $db = Database::getDB();
        $query = 'SELECT * FROM technicians ORDER BY techID';
        $result = $db->query($query);
        $technicians = array();
        foreach ($result as $row) {
            $technician = new Technician($row['firstName'],
                                   $row['lastName'],
                                   $row['email'],
                                   $row['phone'],
                                   $row['password']);
            $technician->setTechID($row['techID']);
            $technicians[] = $technician;
        }
        return $technicians;
    }

    public static function deleteTechnician($techID) {
        $db = Database::getDB();
        $query = "DELETE FROM technicians
                  WHERE techID = '$techID'";
        $row_count = $db->exec($query);
        return $row_count;
    }

    public static function addTechnician($technician) {
        $db = Database::getDB();

        $firstName = $technician->getFirstName();
        $lastName = $technician->getLastName();
        $email = $technician->getEmail();
        $phone = $technician->getPhone();
        $password = $technician->getPassword();

        $query =
            "INSERT INTO technicians
                 (firstName, lastName, email, phone, password)
             VALUES
                 ('$firstName', '$lastName', '$email', '$phone', '$password')";

        $row_count = $db->exec($query);
        return $row_count;
    }
}
?>