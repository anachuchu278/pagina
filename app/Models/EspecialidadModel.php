<?php 
namespace App\Models;

use CodeIgniter\Model;

class EspecialidadModel extends Model{
    protected $table      = 'especialidad';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_Especialidad';
    protected $allowedFields = [
        'tipo'
    ];
}