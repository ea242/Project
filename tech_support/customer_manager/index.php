<?php
require('../model/database.php');
require('../model/customer.php');
require('../model/customer_db.php');
require('../model/country.php');
require('../model/countries_db.php');
require('../model/fields.php');
require('../model/validate.php');
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_customers';
    }
}
switch ($action) {
    case 'list_customers':
        $customers = CustomerDB::get_customers();
        include('customer_list.php');
    break;
    case 'search_customer':
        $lastName = filter_input(INPUT_POST, 'lastName');
        $lastName = ucfirst(strtolower($lastName));
        $customers = CustomerDB::get_customers($lastName);
        include('customer_list.php');
    break;
    case 'show_edit_form':
        $customer_ID = filter_input(INPUT_POST, 'customer_ID');
        $customer = CustomerDB::get_customer($customer_ID);
        $countries = CountriesDB::get_countries();
        include('customer_edit.php'); 
    break; 
    case 'edit_customer':
        $customerID = filter_input(INPUT_POST, 'customerID');
        $firstName = filter_input(INPUT_POST, 'firstName');
        $lastName = filter_input(INPUT_POST, 'lastName');
        $address = filter_input(INPUT_POST, 'address');
        $city = filter_input(INPUT_POST, 'city');
        $state = filter_input(INPUT_POST, 'state');
        $postalCode = filter_input(INPUT_POST, 'postalCode');
        $countryCode = filter_input(INPUT_POST, 'countryCode');
        $phone = filter_input(INPUT_POST, 'phone');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $val = new Validate();
        $error = "Invalid product data. Check all fields and try again.";
        $val->getFields()->addField("First Name",$error);
        $val->getFields()->addField("Last Name",$error);
        $val->getFields()->addField("Address",$error);
        $val->getFields()->addField("City",$error);
        $val->getFields()->addField("State",$error);
        $val->getFields()->addField("Postal Code",$error);
        $val->getFields()->addField("Country Code",$error);
        $val->getFields()->addField("Phone",$error);
        $val->getFields()->addField("Email",$error);
        $val->getFields()->addField("Password",$error);
        $val->text("First Name", $firstName, true, 1, 11);
        $val->text("Last Name", $lastName, true, 1, 11);
        $val->text("Address", $address, true, 1, 50);
        $val->text("City", $city, true, 1, 15);
        $val->text("State", $state, true, 1, 11);
        $val->text("Postal Code", $postalCode, true, 1, 6);
        $val->text("Country Code", $countryCode, true, 1, 10);
        $val->text("Phone", $phone, true, 1, 15);
        $val->email("Email", $email, true);
        $val->text("Password", $password, true, 1, 25);
        if ($val->getFields()->hasErrors()) {
            $error = $val->getFields()->getErrorMessages();
            include('../errors/error.php');
        } else {
            $updateCustomer = new Customer($firstName, $lastName, $address, $city, $state, $postalCode, $countryCode, $phone, $email, $password);
            $updateCustomer->setCustomerID($customerID);
            CustomerDB::updateCustomer($updateCustomer);
            header("Location: .?");
        }
    break;
}
?>