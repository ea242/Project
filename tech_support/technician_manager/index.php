<?php
require('../model/database.php');
require('../model/technician.php');
require('../model/technician_db.php');

require('../model/fields.php');
require('../model/validate.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_technicians';
    }
}

switch ($action) {
    case 'list_technicians':
        $technicians = TechnicianDB::get_technicians();
        include('technician_list.php');
    break;
    case 'delete_technician':
        $techID = filter_input(INPUT_POST, 'techID');
        TechnicianDB::deleteTechnician($techID);
        header("Location: .?");
    break;
    case 'show_add_form':
        include('technician_add.php'); 
    break; 
    case 'add_technician':
        $firstName = filter_input(INPUT_POST, 'firstName');
        $lastName = filter_input(INPUT_POST, 'lastName');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');
        $password = filter_input(INPUT_POST, 'password');

        $val = new Validate();
        $error = "Invalid product data. Check all fields and try again.";
        $val->getFields()->addField("First Name",$error);
        $val->getFields()->addField("Last Name",$error);
        $val->getFields()->addField("Email",$error);
        $val->getFields()->addField("Phone",$error);
        $val->getFields()->addField("Password",$error);

        $val->text("First Name", $firstName, true, 1, 11);
        $val->text("Last Name", $lastName, true, 1, 11);
        $val->email("Email", $email, true);
        $val->phone("Phone", $phone, true);
        $val->text("Password", $password, true, 1, 20);

        if ($val->getFields()->hasErrors()) {
            $error = $val->getFields()->getErrorMessages();
            include('../errors/error.php');
        } else {
            $technician = new Technician($firstName, $lastName, $email, $phone, $password);
            TechnicianDB::addTechnician($technician);
            header("Location: .?");
        }
    break;
}
?>