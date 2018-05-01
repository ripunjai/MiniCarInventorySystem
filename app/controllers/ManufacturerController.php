<?php

namespace App\Controllers;
use App\Core\App;
class ManufacturerController
{
    /**
     * Show the manufacturer page.
     */
    public function manufacturer()
    {
        $manufacturers = App::get('database')->selectDataCondition('id,name, created_date', 'manufacturer','deleted_flag=0 order by id DESC');
        return view('manufacturer', compact('manufacturers'));
    }


    /**
     * Store a new manufacturer in the database.
     */
    public function store()
    {
        App::get('database')->insert('manufacturer', [
            'name' => $_POST['name']
        ]);
    }

    /**
     * delete manufacturer from database.
     */
    public function delete()
    {

        $models = App::get('database')->selectDataCondition('id,name', 'model',"manufacturer_id='{$_POST["manufacturer_id"]}'");
        if( !empty( $models ) ){
            echo json_encode(['status' => 'failed', 'msg' => 'Can not delete since already been used by model.']);
            die;
        }

        if( empty( $models ) ){
            $arrData = [
                'deleted_flag' => '1'
            ];
            $catCondition = "id=". $_POST['manufacturer_id'];
            App::get('database')->UpdateQuery('manufacturer', $arrData,$catCondition);
            echo json_encode(['status' => 'success']);
            die;
        }
        
    }

}
