<?php
session_start();
require('../model/database.php');

require('../model/product.php');
require('../model/product_db.php');

require('../model/customer.php');
require('../model/customer_db.php');

require('../model/fields.php');
require('../model/validate.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'login_screen';
    }
}

switch ($action) {
    case 'login_screen': 
        if(empty($_SESSION["email"])) {
            include('customer_login.php');
        }else{
            $email = $_SESSION["email"];
            $customer = CustomerDB::get_customer_email($email);
            $products = ProductDB::get_products();
            include('register_product_form.php');
        }
    break;
    case 'customer_verify':
        $email = filter_input(INPUT_POST, 'email');

        $val = new Validate();
        $error = "Invalid email. Check all fields and try again.";
        $val->getFields()->addField("Email",$error);

        $val->email("Email", $email, true);

        if ($val->getFields()->hasErrors()) {
            $error = $val->getFields()->getErrorMessages();
            include('../errors/error.php');
        } else {
            $customer = CustomerDB::get_customer_email($email);
            if(!empty($customer->getFirstName())){
                $_SESSION["email"] = $email;
                $products = ProductDB::get_products();
                include('register_product_form.php');
            }else{
                include('../errors/error.php');
            }

        }
    break;
    case 'register_product':
        $customerID = filter_input(INPUT_POST, 'customerID');
        $productID = filter_input(INPUT_POST, 'productID');

        ProductDB::set_product_registered($customerID, $productID);
        
        include('register_product.php');
    break;
    case 'logout':
        session_unset(); 
        session_destroy(); 
        
        header("Location: .?action=login_screen");
    break;
}
?>