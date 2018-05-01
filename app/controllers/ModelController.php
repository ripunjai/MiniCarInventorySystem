<?php

namespace App\Controllers;
use App\Core\App;
class ModelController
{
    
    /**
     * Show the model page.
     */
    public function model()
    {
        $manufacturers = App::get('database')->selectDataCondition('id,name', 'manufacturer','deleted_flag=0 order by id DESC');
        $models = App::get('database')->selectDataCondition('id,manufacturer_id,name, created_date', 'model','deleted_flag=0 order by id DESC');
        return view('model', compact('models','manufacturers'));
    }

    /**
     * Store a new model in the database.
     */
    public function store()
    {
        App::get('database')->insert('model', [
            'name' => $_POST['name'],
            'manufacturer_id' => $_POST['manufacturer_id']
        ]);
    }

    /**
     * delete manufacturer from database.
     */
    public function delete()
    {
        $inventorys = App::get('database')->selectDataCondition('id', 'inventory',"model_id='{$_POST["model_id"]}'");
        if( !empty( $inventorys ) ){
            echo json_encode(['status' => 'failed', 'msg' => 'Can not delete since already been used by model.']);
            die;
        }

        if( empty( $inventorys ) ){
            $arrData = [
                'deleted_flag' => '1'
            ];
            $catCondition = "id=". $_POST['model_id'];
            App::get('database')->UpdateQuery('model', $arrData,$catCondition);
            echo json_encode(['status' => 'success']);
            die;
        }
        
    }
}
