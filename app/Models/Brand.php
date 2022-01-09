<?php
namespace App\Models;
use CodeIgniter\Model;

class Brand extends Model{

    // public function __construct(){
    //     $this->db = \Config\Database::connect();
    //     // helper(['url']);
    // }

    protected $table = 'brand';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'entry_date',
    ];

    public function functionExists($check){
        $this->db = \Config\Database::connect();
        $query = $this->db->table('brand')->select('name')->where('name', $check)->limit(1)->get()->getResultArray();
        return $query;
    }
}

?>