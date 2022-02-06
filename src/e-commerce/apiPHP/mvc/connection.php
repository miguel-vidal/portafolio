<?php

abstract class ConnectionProductos{

    private static $host='localhost';
    private static $dbname='id13963073_ecommerce';
    private static $user='id13963073_root';
    private static $password='g1Y1f4$tz}CZ?e\O';

    private $conn;
    protected $rows=[];

    abstract protected function create();
    abstract protected function read();
    abstract protected function update();
    abstract protected function delete();

    private function db_open(){
        try{
        $this->conn=new PDO('mysql:host=' . 
        self::$host . ';dbname=' .
        self::$dbname,
        self::$user,
        self::$password   
        );
        }catch(PDOException $Exception){
            echo "Can not connect" . $Exception;
        }
    }
    
    private function db_close(){
        $this->conn=null;
    }

    protected function get_query(){
        $this->db_open();
        
        switch($this->opc){

            case "readAll":
                $stmt=$this->conn->query($this->sql);
            break;
            case "readById":
                $stmt=$this->conn->prepare($this->sql);
                $stmt->execute([$this->id]);
            break;
            case "read";
                $stmt=$this->conn->prepare($this->sql);
                $stmt->execute($this->data);
            break;
        }
        
        $this->rows=$stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->db_close();
        $rows=json_encode($this->rows);
        return $rows; 
    }

    protected function set_query(){
        $this->db_open();

        $stmt=$this->conn->prepare($this->sql);
        switch($this->opc){
            case "insert":
                $stmt->execute($this->data);
                $success=$stmt->rowCount();
            break;
            case "update":
                $stmt->execute($this->data);
                $success=$stmt->rowCount(); //checar cuantas filas fueron afectadas
            break;
            case "delete":
                $stmt->execute([$this->id]);
                $success=$stmt->rowCount();
            break;
        }

        //si por lo menos una fila fue afectada en la BD landa mensaje de exito
        return ($success > 0)
        ?  json_encode(["message"=>"exito"])
        :  json_encode(["message"=>"error"]);

        $this->db_close();
    }

}