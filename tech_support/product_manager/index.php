<?php
require('../model/database.php');
require('../model/products.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_products';
    }
}

switch ($action) {
    case 'under_construction':
        include('../under_construction.php');
        break;
    case 'list_products':
        $products = get_products();
        include('product_list.php');
    break;
    case 'delete_product':
        $product_id = filter_input(INPUT_POST, 'product_id');
        if ($product_id == NULL || $product_id == FALSE) {
            $error = "Missing or incorrect product id or category id.";
            include('../errors/error.php');
        } else { 
            delete_product($product_id);
            header("Location: .?");
        }
    break;
}
?>