<?php 
namespace App\Models;

use CodeIgniter\Model;

class UsuarioModelo extends Model{
    protected $table      = 'usuario';
    
    protected $primaryKey = 'id_Usuario'; 

    protected $useAutoIncrement = true; 

    protected $allowedFields = ['nombre','password','email','id_rol','id_especialidad','id_horamed','imagen_ruta']; 

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
    public function getRol($idUsuario){
        return $this->db->table($this->table)
            ->select('usuario.*, rol.nombre_rol') 
            ->join('rol', 'rol.id_rol = usuario.id_rol')
            ->where('usuario.id_Usuario', $idUsuario)
            ->get()
            ->getRowArray();
    } 
    public function getAdmin(){
        return $this->db->table($this->table) 
            ->select('usuario.*')
            ->join('rol', 'rol.id_rol = usuario.id_rol')
            ->where('rol.nombre_rol', 'Admin')
            ->get()
            ->getResultArray();
    }
    public function deleteAdmin($id_Usuario){
        return $this->db->table('usuario')
                        ->where('id_Usuario', $id_Usuario)
                        ->delete();
    }
}