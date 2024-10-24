<?php 
namespace App\Models;

use CodeIgniter\Model;

class EstadoModel extends Model{
    protected $table      = 'Estado';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_Estado';
    protected $allowedFields = [
        'estado'
    ];
    
}