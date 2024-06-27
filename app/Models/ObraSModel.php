<?php 
namespace App\Models;

use CodeIgniter\Model;

class ObraSModel extends Model{
    protected $table      = 'obra_social';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_Obra';
    protected $allowedFields=[
        'nombre'
    ];
    public function getObras($id = false)
    {
        if ($id === false) {
            return $this->findAll() ? $this->findAll() : [];
        } else {
            return $this->where(['id_Obra' => $id])->first() ? $this->where(['id_Obra' => $id])->first() : [];
        }
    }
}