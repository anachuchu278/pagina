<?php 
namespace App\Models;

use CodeIgniter\Model;

class MetPagoModel extends Model{
    protected $table      = 'met_pago';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_Metpago';
    protected $allowedFields = [
        'metodo'
    ];
}