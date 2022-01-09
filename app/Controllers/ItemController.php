<?php
namespace App\Controllers;

use App\Models\Item;
use App\Models\Model_ci;
use App\Models\Brand;
use App\Models\CustomModel;
use CodeIgniter\I18n\Time;

class ItemController extends BaseController
{
    // public function __construct(){
    //     $this->db = \Config\Database::connect();
    //     // helper(['url']);
    // }

    public function index($id = 0)
    {
        $brand = new Brand();
        $model = new Model_ci();
        $item = new Item();

        $data['item'] = $item->select('items.id as item_id, items.item as item_name, items.entry_date, items.model_id, items.brand_id, models.model_name, brand.name as brand_name')
                        ->join('models', 'models.id = items.model_id', 'left')
                        ->join('brand', 'brand.id = items.brand_id', 'left')
                        ->orderBy('entry_date', 'DESC')
                        // ->join('models m', 'm.brand_id = brand.id')
                        ->get()
                        ->getResultArray();
        $data['brand'] = $brand->orderBy('entry_date', 'ASC')->findAll();
        $data['model'] = $model->select('models.id as model_id, models.model_name, models.entry_date, models.brand_id, brand.name as brand_name')
                        ->join('brand', 'brand.id = models.brand_id')
                        ->orderBy('entry_date', 'ASC')->get()->getResultArray();
        // echo "<pre>";
        // print_r($data['model']);
        // die();
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        return view('item/list_item', $data);
        // select('items.id as item_id, items.item as item_name, items.entry_date, models.model_name, brand.name as brand_name')
    }

    public function add_item()
    {
        $item = new Item();
        $check_item_name = $this->request->getPost('check_item_name');
        $check_brand_name = $this->request->getPost('brand_id');
        $check_model_name = $this->request->getPost('model_id');
        $exists = $item->functionExists($check_item_name, $check_brand_name, $check_model_name);
        $count = count($exists);
        if(empty($count)){
            $data = [
                'brand_id' => $this->request->getPost('brand_id'),
                'model_id' => $this->request->getPost('model_id'),
                'item' => $this->request->getPost('item_name')
            ];
            $save = $item->save($data);
            // echo "<pre>";
            // print_r($data);
            // die();
            $data = ['status' => 'Item has been added Successfully'];
            return $this->response->setJSON($data);
        }else{
            $data = ['status' => 'Item is Already Exists'];
            return $this->response->setJSON($data);
        }
        
        
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

    public function edit_item()
    {
        $item = new Item();
        $item_id = $this->request->getPost('id');
        $data['items'] = $item->find($item_id);
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

    public function update_item()
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
 
        $item = new Item();

        // $model['models'] = $this->db->table('models')
        //                 ->distinct('brand_id')
        //                 ->join('brand', 'models.brand_id = brand.id')
        //                 ->get()
        //                 ->getResultArray();

        $item_id = $this->request->getPost('item_id');

        // $input_value = $this->request->getVar('input_value');
        // $input_type = $this->request->getVar('input_type');
        // if($input_type == 'model_name'){
        //     $type = $model->select('items.id as item_id, items.item as item_name, items.brand_id, items.model_id, brand.name as brand_name, models.model_name')
        //           ->join('brand', 'brand.id = items.brand_id')
        //           ->join('models', 'models.id = items.model_id')
        //           ->where('items.item ', $input_value)
        //           ->get()
        //           ->getResultArray();
        // }

        $data = [
            'brand_id' => $this->request->getPost('brand_id_update'),
            'model_id' => $this->request->getPost('model_id_update'),
            'item' => $this->request->getPost('item_name_update'),
        ];
        // echo '<pre>';
        // print_r($this->request->getPost());
        // echo '</pre>';
        $update = $item->update($item_id,$data);
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        $data = ['status' => 'Item has been Updated Successfully'];
        return $this->response->setJSON($data);

        // if($update != false){
        //     $data = $model->where('id', $id)->first();
        //     echo json_encode(array("status" => true , 'data' => $data));
        // }
    }

    public function delete_item()
    {
        $item = new Item();
        $item->delete($this->request->getPost('item_id_del'));
        $message = ['status' => 'Item is deleted Successfully'];
        return $this->response->setJSON($message);
    }
}