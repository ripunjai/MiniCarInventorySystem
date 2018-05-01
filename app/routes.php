 <?php

$router->get('MiniCarInventorySystem', 'DashboardController@home');

$router->get('MiniCarInventorySystem/manufacturer', 'ManufacturerController@manufacturer');
$router->post('MiniCarInventorySystem/manufacturer/store', 'ManufacturerController@store');
$router->post('MiniCarInventorySystem/manufacturer/delete', 'ManufacturerController@delete');


$router->get('MiniCarInventorySystem/model', 'ModelController@model');
$router->post('MiniCarInventorySystem/model/store', 'ModelController@store');
$router->post('MiniCarInventorySystem/model/delete', 'ModelController@delete');


$router->get('MiniCarInventorySystem/add-inventory', 'InventoryController@createInventory');
$router->post('MiniCarInventorySystem/inventory/store', 'InventoryController@store');

$router->get('MiniCarInventorySystem/inventory', 'InventoryController@inventory');
$router->post('MiniCarInventorySystem/inventory/getmodel', 'InventoryController@getModel');
$router->post('MiniCarInventorySystem/inventory/view-inventory', 'InventoryController@viewInventory');
$router->post('MiniCarInventorySystem/inventory/delete-inventory', 'InventoryController@deleteInventory');


