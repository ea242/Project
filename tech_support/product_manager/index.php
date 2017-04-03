<?php
require('../model/database.php');
// require('../model/product_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'under_construction';
    }
}

switch ($action) {
    case 'under_construction':
        include('../under_construction.php');
        break;
}
?>