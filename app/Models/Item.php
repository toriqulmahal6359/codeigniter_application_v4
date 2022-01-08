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
    
}

?>