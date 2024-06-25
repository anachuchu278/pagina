<?php 
namespace App\Models;

use CodeIgniter\Model;

class TurnoModel extends Model{
    protected $table      = 'turno';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id_Turno';
    protected $allowedFields =[
        'fecha_hora',
        'codigo_turno',
        'id_usuario',
        'id_paciente',
        'id_estado',
        'id_pago'
    ];

    public function insertarTurno($data){
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
    public function getTurnosPorPaciente($pacienteId) {
        $builder = $this->db->table('turno');
        $builder->select('turno.*, especialidad.tipo', 'usuario.email');
        $builder->join('usuario', 'turno.id_usuario = usuario.id_Usuario');
        $builder->join('especialidad', 'especialidad.id = usuario.id_especialidad');
        $builder->where('turno.id_usuario', $pacienteId);
        return $builder->get()->getResult();
    }

    public function getEstado($idEstado){
        return $this->where('id_estado',$idEstado)->findAll();
    }
}