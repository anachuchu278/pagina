<?php 
namespace App\Models;

use CodeIgniter\Model;

class DetPagoModelo extends Model{
    protected $table      = 'det_pago';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_Det_pago';
    protected $allowedFields = [
        'monto',
        'id_metodop'
    ];
    public function insertarDatos($dato){
        $query = $this->db->table($this->table)->insert($dato);
        return $query;
    }
}