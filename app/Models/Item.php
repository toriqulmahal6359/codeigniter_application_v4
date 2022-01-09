<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Item extends Model{
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'brand_id',
        'model_id',
        'item',
        'entry_date'
    ];

    // public function __construct(){
    //     parent::__construct();
    //     $db = \Config\Database::connect();
    //     $builder = $db->table('item');
    // }

    public function functionExists($check, $check_a, $check_b){
        $this->db = \Config\Database::connect();
        $query = $this->db->table('items')->select('items.id as item_id, items.item as item_name, items.brand_id, items.model_id')
                ->join('brand', 'brand.id = items.brand_id')
                ->join('models', 'models.id = items.model_id')
                ->where([
                    'items.item' => $check,
                    'items.brand_id' => $check_a,
                    'items.model_id' => $check_b
                ])
                ->limit(1)->get()->getResultArray();
        return $query;
    }
    
}

?>