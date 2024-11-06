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
        'id_Usuario'
    ];
    public function getHorario($id = false){
        if ($id === false) {
            return $this->findAll() ? $this->findAll() : [];
        } else {
            return $this->where(['id_Horario' => $id])->first() ? $this->where(['id_Horario' => $id])->first() : [];
        }
    }
    public function insertData($data)
    {
        $this->db->table($this->table)-> insert($data);
        return redirect()->to('');
    }
    public function deleteHorario($id)
    {
        $query = $this->db->table($this->table)->delete(array('id_Horario' => $id));
        return $query;
    } 
    public function getUsuario($id = false)
    {
        if ($id === false) {
            return $this->findAll() ? $this->findAll() : [];
        } else {
            return $this->where(['id_Horario' => $id])->first() ? $this->where(['id_Horario' => $id])->first() : [];
        }
    }
}