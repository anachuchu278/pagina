<?php 
namespace App\Models;

use CodeIgniter\Model;

class TurnoModel extends Model{
    protected $table      = 'turno';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_Turno';
    protected $allowedFields =[
        'id_Horario',
        'codigo_turno',
        'id_Usuario',
        'id_paciente',
        'id_Estado',
        'fecha_turno'
    ];
    public function insertarDatos($data){
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
    public function getTurno($id = false)
    {
        if ($id === false) {
            return $this->findAll() ? $this->findAll() : [];
        } else {
            return $this->where(['id_Turno' => $id])->first() ? $this->where(['id_Turno' => $id])->first() : [];
        }
    }
    public function editarTurno($data){
        $query = $this->db->table($this->table)->update($data);
        return $query;
    }
    public function updateTurno($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id_Turno' => $id));
        return $query;
    }
        public function deleteTurno($id)
    {
        $query = $this->db->table($this->table)->delete(array('id_Turno' => $id));
        return $query;
    } 
    public function getTurnosPorUsuario($userId) {
        return $this->where('id_Usuario', $userId)->findAll();
    }

    public function getEstado($idEstado){
        return $this->where('id_estado',$idEstado)->findAll();
    } 
}
