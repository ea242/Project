<?php
require('../model/database.php');
require('../model/product.php');
require('../model/product_db.php');

require('../model/fields.php');
require('../model/validate.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_products';
    }
}

switch ($action) {
    case 'list_products':
        $products = ProductDB::get_products();
        include('product_list.php');
    break;
    case 'delete_product':
        $product_id = filter_input(INPUT_POST, 'product_id');
        ProductDB::deleteProduct($product_id);
        header("Location: .?");
    break;
    case 'show_add_form':
        include('product_add.php'); 
    break; 
    case 'add_product':
        $code = filter_input(INPUT_POST, 'code');
        $name = filter_input(INPUT_POST, 'name');
        $version = filter_input(INPUT_POST, 'version');
        $releaseDate = filter_input(INPUT_POST, 'releaseDate');

        $val = new Validate();
        $error = "Invalid product data. Check all fields and try again.";
        $val->getFields()->addField("Code",$error);
        $val->getFields()->addField("Name",$error);
        $val->getFields()->addField("Version",$error);
        $val->getFields()->addField("Date",$error);

        $val->text("Code", $code, true, 1, 11);
        $val->text("Name", $name, true, 1, 11);
        $val->number("Version", $version, true, 1, 11);
        $val->date("Date", $releaseDate, true, 1, 11);

        if ($val->getFields()->hasErrors()) {
            $error = $val->getFields()->getErrorMessages();
            include('../errors/error.php');
        } else {
            $product = new Product($code, $name, $version, $releaseDate);
            ProductDB::addProduct($product);
            header("Location: .?");
        }
    break;
}
?>