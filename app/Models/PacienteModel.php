<?php 
namespace App\Models;

use CodeIgniter\Model;

class PacienteModel extends Model{
    protected $table      = 'paciente';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_Paciente';
    protected $allowedFields = [
        'nombre',
        'apellido', 
        'peso',
        'altura_cm',
        'edad',
        'dni',
        'historia_clinica',
        'id_usuario',
        'id_tipo_sangre',
        'id_obra'
    ];

    public function insertarPaciente($data){
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
    public function getPaciente($id = false)
    {
        if ($id === false) {
            return $this->findAll() ? $this->findAll() : [];
        } else {
            return $this->where(['id_Paciente' => $id])->first() ? $this->where(['id_Paciente' => $id])->first() : [];
        }
    }
    public function getPacientePorUsuarioID($id)
    {
        $query = $this->db->table($this->table)->where(['id_usuario' => $id])->first() ? $this->where(['id_usuario' => $id])->first() : [];
        return $query;
    }
    public function editarPaciente($data){
        $query = $this->db->table($this->table)->update($data);
        return $query;
    }
    public function updatePaciente($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id_Paciente' => $id));
        return $query;
    }
        public function deletePaciente($id)
    {
        $query = $this->db->table($this->table)->delete(array('id_Paciente' => $id));
        return $query;
    } 
}