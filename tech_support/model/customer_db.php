<?php
class CustomerDB {
    function get_customers($lastName = "") {
        $db = Database::getDB();
        if($lastName === ""){
            $query = 'SELECT * FROM customers ORDER BY customerID';
        }else{
            $query = "SELECT * FROM customers WHERE lastName = '$lastName' ORDER BY customerID";
        }
        $result = $db->query($query);
        $customers = array();
        foreach ($result as $row) {
            $customer = new Customer($row['firstName'],
                                   $row['lastName'],
                                   $row['address'],
                                   $row['city'],
                                   $row['state'],
                                   $row['postalCode'],
                                   $row['countryCode'],
                                   $row['phone'],
                                   $row['email'],
                                   $row['password']);
            $customer->setCustomerID($row['customerID']);
            $customers[] = $customer;
        }
        Database::closeDB();
        return $customers;
    }

    function get_customer($customer_ID) {
        $db = Database::getDB();
        $query = "SELECT * FROM customers WHERE customerID = '$customer_ID'";
        $result = $db->query($query);
        $row = $result->fetch();
        $customer = new Customer($row['firstName'],
                                $row['lastName'],
                                $row['address'],
                                $row['city'],
                                $row['state'],
                                $row['postalCode'],
                                $row['countryCode'],
                                $row['phone'],
                                $row['email'],
                                $row['password']);
        $customer->setCustomerID($row['customerID']);
        Database::closeDB();
        return $customer;
    }

    function get_customer_email($email) {
        $db = Database::getDB();
        $query = "SELECT * FROM customers WHERE email = '$email'";
        $result = $db->query($query);
        $row = $result->fetch();
        $customer = new Customer($row['firstName'],
                                $row['lastName'],
                                $row['address'],
                                $row['city'],
                                $row['state'],
                                $row['postalCode'],
                                $row['countryCode'],
                                $row['phone'],
                                $row['email'],
                                $row['password']); 
        $customer->setCustomerID($row['customerID']);
        Database::closeDB();
        return $customer;
    }

    public static function updateCustomer($customer) {
        $db = Database::getDB();

        $customerID = $customer->getCustomerID();
        $firstName = $customer->getFirstName();
        $lastName = $customer->getLastName();
        $address = $customer->getAddress();
        $city = $customer->getCity();
        $state = $customer->getState();
        $postalCode = $customer->getPostalCode();
        $countryCode = $customer->getCountryCode();
        $phone = $customer->getPhone();
        $email = $customer->getEmail();
        $password = $customer->getPassword();

        $query = "  UPDATE customers
                    SET firstName = '$firstName',
                        lastName = '$lastName',
                        address = '$address',
                        city = '$city',
                        state = '$state',
                        postalCode = '$postalCode',
                        phone = '$phone',
                        email = '$email',
                        password = '$password'
                    WHERE customerID = '$customerID'";

        $row_count = $db->exec($query);
        Database::closeDB();
    }
}
?>