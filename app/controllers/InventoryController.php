<?php

namespace App\Controllers;
use App\Core\App;
class InventoryController
{

    
    /**
     * Show the inventory page.
     */
    public function inventory()
    {
        $inventorys = App::get('database')->selectDataCondition('id,manufacturer_id,model_id,  COUNT(*) TotalByOrder', 'inventory','deleted_flag=0 GROUP BY manufacturer_id,model_id order by id DESC');
        return view('inventory', compact('inventorys'));
    }

    public function createInventory()
    {
        $manufacturers = App::get('database')->selectDataCondition('id,name', 'manufacturer','deleted_flag=0 order by id DESC');
        return view('add-inventory', compact('manufacturers'));
    }

    public function viewInventory()
    {
        $viewInventorys = App::get('database')->selectDataCondition('*', 'inventory',"manufacturer_id='{$_POST['manufacturer_id']}' AND model_id='{$_POST['model_id']}' AND deleted_flag=0");
        $htmlData = view('view-inventory', compact('viewInventorys'));
        echo $htmlData;
    }

    public function deleteInventory()
    {
        $arrData = [
            'deleted_flag' => '1'
        ];
        $catCondition = "id=".$_REQUEST['inventory_id'];
        App::get('database')->UpdateQuery('inventory', $arrData,$catCondition);
    }
    

     /**
     * Get model from database.
     */
    public function getModel(){
        $modelQuery = App::get('database')->selectDataCondition("id,name", "model","manufacturer_id='{$_POST['manufacturer_id']}' AND deleted_flag=0 ");
        print_r(json_encode($modelQuery));
    }


     /**
     * Store a new model in the database.
     */
    public function store()
    {
        $filename = $filename1 = '';

        if( isset( $_FILES["mainImg"]["name"]) && ($_FILES["mainImg"]["name"] != '')){
            $folder = "public/images/inventory-images/"; 
            $file = explode(".", $_FILES["mainImg"]["name"]);
            $filename = round(microtime(true)*1000) . '.' . end($file);
            $full_path = $folder.$filename; 
            move_uploaded_file($_FILES['mainImg']['tmp_name'], $full_path);
        }

        if( isset( $_FILES["otherImgs"]["name"]) && ($_FILES["otherImgs"]["name"] != '')){
            $file1 = explode(".", $_FILES["otherImgs"]["name"]);
            $filename1 = round(microtime(true)*2000) . '.' . end($file1);
            $full_path1 = $folder.$filename1; 
            move_uploaded_file($_FILES['otherImgs']['tmp_name'], $full_path1);
        }

        App::get('database')->insert('inventory', [
            'model_id'=>$_POST['model_id'],
            'manufacturer_id'=>$_POST['manufacturer_id'],
            'color'=>$_POST['color'],
            'manufacturing_year'=>$_POST['manufacturing_year'],
            'registration_number'=>$_POST['registration_number'],
            'note'=>$_POST['note'],
            'img1' => $filename,
            'img2' => $filename1,
        ]);
    }
}
