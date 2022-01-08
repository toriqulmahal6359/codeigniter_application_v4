<?php
namespace App\Controllers;

use App\Models\Model_ci;
use App\Models\Brand;
use App\Models\CustomModel;
use CodeIgniter\I18n\Time;

class ModelController extends BaseController
{
    // public function __construct(){
    //     $this->db = \Config\Database::connect();
    //     // helper(['url']);
    // }

    public function insert_data($data) {
        if($this->db->table($this->table)->insert($data))
               {
                   return $this->db->insertID();
               }
               else
               {
                   return false;
               }
    }

    public function index($id = 0)
    {
        // $db = db_connect();
        // $models = new CustomModel($db);
        // $result = $models->all_data();
        // $result = $models->getBrand();
       
        // echo '<pre>';
        // print_r($data['models']);
        // echo '</pre>';
        $brand_model = new Brand();
        $models = new Model_ci();
        $data['model'] = $models->select('models.id as model_id, models.model_name, models.entry_date, models.brand_id, brand.name as brand_name')
                        ->join('brand', 'brand.id = models.brand_id')
                        ->orderBy('entry_date', 'ASC')
                        ->get()
                        ->getResultArray();
        
                        // ->getResultArray();
        $data['brands'] = $brand_model->orderBy('name', 'ASC')->findAll();
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // $data['models'] = $models->findAll();
        return view('model/list_model', $data);
    }

    public function add_model()
    {
        $model = new Model_ci();
        // $data['models'] = $model->table('models')
        //                 ->join('brand', 'brand.id = models.brand_id ')
        //                 ->get()
        //                 ->getResultArray();
        $data = [
            'brand_id' => $this->request->getPost('brand_id'),
            'model_name' => $this->request->getPost('model_name')
        ];
        $save = $model->save($data);
        $data = ['status' => 'Model has been added Successfully'];
        return $this->response->setJSON($data);
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // if($save != false){
        //     $data = $this->db->table('models')->where('id', $save)->first();
        //     echo json_encode(array("status" => true , 'data' => $data));
        //  }
    }

    // public function fetch_brand()
    // {
    //     $brands = new Brand();
    //     $data['brands'] = $brands->findAll();
    //     return view('brand/list_brand', $data);
    //     // return $this->response->setJSON($data);
    // }

    public function edit_model()
    {
        $models = new Model_ci();
        $model_id = $this->request->getPost('id');
        $data['models'] = $models->find($model_id);
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        return $this->response->setJSON($data);
        // $model = new Model_ci();
        // $data = $model->where('id', $id)->first();
        // if($data){
        //     echo json_encode(array("status" => true , 'data' => $data));
        // }
    }

    public function update_model()
    {
        // $models = new Model_ci();
        // $model_id = $this->request->getPost('model_id');
        // $data = [
        //     'brand_id' => $this->request->getPost('brand_id'),
        //     'name' => $this->request->getPost('model_name'),
        // ];
        // $models->update($model_id, $data);
        // $message = ['status' => 'Model has been updated Successfully'];
        // return $this->response->setJSON($data);
 
        $model = new Model_ci();

        // $model['models'] = $this->db->table('models')
        //                 ->distinct('brand_id')
        //                 ->join('brand', 'models.brand_id = brand.id')
        //                 ->get()
        //                 ->getResultArray();

        $model_id = $this->request->getPost('model_id');
        $data = [
            'brand_id' => $this->request->getPost('brand_id_update'),
            'model_name' => $this->request->getPost('model_name_update')
        ];
        // echo '<pre>';
        // print_r($this->request->getPost());
        // echo '</pre>';
        $update = $model->update($model_id, $data);
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        $data = ['status' => 'Model has been Updated Successfully'];
        return $this->response->setJSON($data);

        // if($update != false){
        //     $data = $model->where('id', $id)->first();
        //     echo json_encode(array("status" => true , 'data' => $data));
        // }
    }

    public function delete_model()
    {
        $model = new Model_ci();
        $model->delete($this->request->getPost('model_id_del'));
        $message = ['status' => 'Model is deleted Successfully'];
        return $this->response->setJSON($message);
    }
}