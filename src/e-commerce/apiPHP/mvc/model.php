<?php

require_once("connection.php");

class Model extends ConnectionProductos{

    public function __construct(){
        $this->table="productos";
        $this->tableUser="usuarios";
        $this->tableCompras="compras";
    }

    public function create($data=[]){

        $this->nombre=$data[0];
        $this->precio=$data[1];
        $this->foto=$data[2];
        $this->sql="insert into ". $this->table. "(nombre,precio,foto) values(?,?,?)";
        $this->opc="insert";
        $this->data=[$this->nombre, $this->precio, $this->foto];
        $result=$this->set_query();
        return $result;
    }
  
    public function read($id=''){
        
        $this->sql=($id != "") 
        ? "select * from $this->table where idProducto=?"
        : "select * from $this->table";

        $this->opc=($id != "")
        ? "readById"
        : "readAll";

        $this->id=$id;

        $result=$this->get_query();

        return $result;
        
    }
    public function update($data=[]){
        
        $this->sql="update ".$this->table ." set nombre=?, precio=?, foto=? where idProducto=?";
        $this->data=$data;
        $this->opc="update";
        
        $result=$this->set_query();
        return $result;
    }

    public function delete($id=''){
        $this->id=$id;
        $this->opc="delete";
        $this->sql="delete from ".$this->table." where idProducto=?";

        $result=$this->set_query();
        return $result;
    }

    //CRUD USER
    public function createNewUser($data=[]){

        $this->opc="insert";
        $this->email=$data["email"];
        $this->password=$data["password"];
        $this->name=$data["name"];
        $this->lastname=$data["lastname"];
        $this->data=[$this->email, $this->password, $this->name, $this->lastname];
        $this->sql="insert into ".$this->tableUser."(email, password, name, lastname) values(?,?,?,?)";
        $result=$this->set_query();
        return $result;

    }

    public function loginUser($data=[]){
        $this->opc="read";
        $this->email=$data["email"];
        $this->password=$data["password"];
        $this->data=[$this->email, $this->password];
        $this->sql="select * from " .$this->tableUser . " where email=? and password=?";
        $result=$this->get_query();
        return $result;
    }

    //CRUD CARRITO
    public function makepurchaseandsave($idProduct,$cantidad ,$idUser){
        $this->data=[$idUser, $idProduct, $cantidad];
        $this->sql="insert into ". $this->tableCompras."(idUsuario, idProducto, cantidadProducto) values(?,?,?);";
        $this->opc="insert";
        $result=$this->set_query();
        return $result;
        
    }

    public function readProductsByUser($id=''){

        $this->sql="select * from $this->tableCompras where idUsuario=?";
        $this->opc="readById";
        $this->id=$id;
        $result=$this->get_query();
        return $result;
    }

}