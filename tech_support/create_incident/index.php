<?php
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
        $action = 'create_incident_screen';
    }
}

switch ($action) {
    case 'create_incident_screen':
        include('get_customer.php');
    break;
    case 'customer_get':
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
                $products = ProductDB::get_product_registered($customer->getCustomerID());
                include('incident_add_form.php');
            }else{
                include('../errors/error.php');
            }

        }
    break;
    case 'incident_add':
        $title = filter_input(INPUT_POST, 'title');
        $description = filter_input(INPUT_POST, 'description');

        $val = new Validate();
        $error = "Invalid Entry. Check all fields and try again.";
        $val->getFields()->addField("Title",$error);
        $val->getFields()->addField("Description",$error);

        $val->text("Title", $title, true,1,20);
        $val->text("Description", $description, true,1,1000);

        if ($val->getFields()->hasErrors()) {
            $error = $val->getFields()->getErrorMessages();
            include('../errors/error.php');
        } else {
            include('incident_add.php');
        }
    break;
    /*case 'customer_verify':
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

        //logic needed for registering product
        
        include('register_product.php');
    break;*/
}
?>