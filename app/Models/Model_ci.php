<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Model_ci extends Model{
    protected $table = 'models';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'brand_id',
        'model_name',
        'entry_date'
    ];

    // public function __construct(){
    //     parent::__construct();
    //     $db = \Config\Database::connect();
    //     $builder = $db->table('models');
    // }

    public function functionExists($check, $check_a){
        $this->db = \Config\Database::connect();
        $query = $this->db->table('models')->select('models.id as model_id, models.model_name, models.brand_id')
                ->join('brand', 'brand.id = models.brand_id')
                ->where([
                    'models.model_name' => $check,
                    'models.brand_id' => $check_a
                ])
                ->limit(1)->get()->getResultArray();
        return $query;
    }
    
}

?>