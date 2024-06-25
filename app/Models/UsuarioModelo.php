<?php 
namespace App\Models;

use CodeIgniter\Model;

class UsuarioModelo extends Model{
    protected $table      = 'usuario';
    
    protected $primaryKey = 'id_Usuario'; 
  
    protected $useAutoIncrement = true; 

    protected $allowedFields = ['nombre','password','email','id_rol','id_especialidad','id_horamed']; 

    //protected $createdFields = 'created-at'; 
    public function insertData($data)
    {
        $this->db->table($this->table)-> insert($data);
        return redirect()->to('index');
    }
    public function getUsuario($id = false)
    {
        if ($id === false) {
            return $this->findAll() ? $this->findAll() : [];
        } else {
            return $this->where(['id_Usuario' => $id])->first() ? $this->where(['id_Usuario' => $id])->first() : [];
        }
    }
    public function editarUsuario($data)
    {
        $query = $this->db->table($this->table)->update($data);
        return $query;
    }
    public function getMedicos()
    {
        
    }
}