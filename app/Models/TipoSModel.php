<?php 
namespace App\Models;

use CodeIgniter\Model;

class TipoSModel extends Model{
    protected $table      = 'tipo_sanguineo';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_sangre';
    protected $allowedFields=[
        'tipo'
    ];
    public function getTipoSan($id = false)
    {
        if ($id === false) {
            return $this->findAll() ? $this->findAll() : [];
        } else {
            return $this->where(['id_sangre' => $id])->first() ? $this->where(['id_sangre' => $id])->first() : [];
        }
    }
}