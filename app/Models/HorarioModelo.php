<?php 
namespace App\Models;

use CodeIgniter\Model;

class HorarioModelo extends Model{
    protected $table      = 'horario_medico';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_Horario',
        'dia_sem',
        'hora_inicio',
        'hora_final',
        'id_usuario'
    ];
    public function insertData($data)
    {
        $this->db->table($this->table)-> insert($data);
        return redirect()->to('');
    }
}