<?php
namespace App\Models;
use CodeIgniter\Model;

class Brand extends Model{
    protected $table = 'brand';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'entry_date',
    ];
}

?>