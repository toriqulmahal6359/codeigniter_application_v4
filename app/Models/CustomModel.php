<?php 
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;

class CustomModel
{
    protected $db;

    public function __construct(ConnectionInterface &$db){
        $this->db = &$db;
    }

    function all_data(){
        //SELECT * FROM models
        return $this->db->table('models')->orderBy('entry_date', 'ASC')->get()->getResult(); 
    }

    function getBrand(){
        $builder = $this->db->table('models');
        $builder->join('brand','models.brand_id = brand.id');
        $models = $builder->get()->getRow();
        return $models;
    }
}