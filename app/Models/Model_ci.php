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
    
}

?>