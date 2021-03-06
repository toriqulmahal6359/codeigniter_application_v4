<?php
namespace App\Controllers;
use App\Models\Brand;
use CodeIgniter\I18n\Time;

class BrandController extends BaseController
{

    public function index()
    {
        $brands = new Brand();
        $data['brands'] = $brands->orderBy('entry_date', 'DESC')->findAll();
        return view('brand/list_brand', $data);
    }

    public function add_brand()
    {
        $brand = new Brand();
        helper('date');
        $now = now();
        $datetime = date('Y-m-d H:i:s', strtotime($now));
        $check_brand_name = $this->request->getPost('check_brand_name');
        $exists = $brand->functionExists($check_brand_name);
        $count = count($exists);
        if(empty($count)){
            $data = [
                'name' => $this->request->getPost('name'),
            ];
            $brand->save($data);
            $data = ['status' => 'Brand has been added Successfully'];
            return $this->response->setJSON($data);
        }else{
            $data = ['status' => 'Brand name is Already Exists'];
            return $this->response->setJSON($data);
        }
            
    }

    // public function fetch_brand()
    // {
    //     $brands = new Brand();
    //     $data['brands'] = $brands->findAll();
    //     return view('brand/list_brand', $data);
    //     // return $this->response->setJSON($data);
    // }

    public function edit_brand()
    {
        $brands = new Brand();
        $brand_id = $this->request->getPost('id');
        $data['brands'] = $brands->find($brand_id);
        return $this->response->setJSON($data);
    }

    public function update_brand()
    {
        $brands = new Brand();
        

        // $input_value = $this->request->getVar('input_value');
        // $input_type = $this->request->getVar('input_type');
        // if($input_type == 'brand_name'){
        //     $type = $brands->select('*')->where('name', $input_value)->get();
        // }
        // $check_brand_name = $this->request->getPost('check_brand_name');
        // $query = $brands->select('name')->where('name', $check_brand_name)->limit(1)->get();
        // if($query == "1"){
        //     echo "1";
        // }
            $brand_id = $this->request->getPost('brand_id');
            $check_brand_name = $this->request->getPost('check_brand_name');
            $exists = $brands->functionExists($check_brand_name);
            $count = count($exists);
            if(empty($count)){
                $data = [
                    'id' => $this->request->getPost('brand_id'),
                    'name' => $this->request->getPost('brand_name'),
                ];
                $brands->update($brand_id, $data);
                $message = ['status' => 'Brand has been updated Successfully'];
                return $this->response->setJSON($data);
            }else{
                $data = ['status' => 'Brand name is Already Exists'];
                return $this->response->setJSON($data);
            }
            
    }

    public function delete_brand()
    {
        $brand = new Brand();
        $brand->delete($this->request->getPost('brand_id_del'));
        $message = ['status' => 'Brand is deleted Successfully'];
        return $this->response->setJSON($message);
    }
}