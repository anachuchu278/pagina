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
        'id_Usuario',
        'id_Sangre',
        'id_Obra'
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
    public function getPacientePorUsuarioID($idUsuario)
    {
        return $this->db->query("select id_Paciente FROM paciente where id_Usuario = $idUsuario")->getRowArray();
    }
    // public function getPacientePorDNI($search = false){
    //     if ($search === false){
    //         return redirect()->to('error');
    //     } else {
    //         return $this->where(['dni' => $search])->first() ? $this->where(['dni' => $search])->first() : [];
    //     }
    // }
    public function getPacientePorDNI($search){
        return $this->db->table($this->table) 
            ->select('paciente.id_Paciente')
            ->where('paciente.dni', $search)
            ->get()
            ->getResultArray();
    }
    public function editarPaciente($id, $data){
        $query = $this->db->table($this->table)->update($data, array('id_Paciente' => $id));
        return $query;
    }
        public function deletePaciente($id)
    {
        $query = $this->db->table($this->table)->delete(array('id_Paciente' => $id));
        return $query;
    } 
}
