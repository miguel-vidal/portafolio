<?php

require_once("model.php");
// ver ruta padre en un servidor real echo $_SERVER['DOCUMENT_ROOT'];
class Controller{
    private $model;

    public function __construct(){
        
        $this->model=new Model();
    }

    //CRUD para tabla Productos

    
    public function create($data){
       
        //debe venir una foto para poder guardar en BD
        if (($_FILES['foto']['name']!="")){
                $target_dir = "upload/";
                $file = $_FILES['foto']['name'];
                $path = pathinfo($file);
                $filename = $path['filename'];
                $ext = $path['extension'];
                $temp_name = $_FILES['foto']['tmp_name'];
                //nombre directorio/imagen.extension
                $path_filename_ext = $target_dir.$filename.".".$ext;
                
                // Check if file already exists
        if (file_exists($path_filename_ext)) {
                return json_encode(["message"=>"Esta imagen ya existe, por favor sube otra"]);
        }else{
                move_uploaded_file($temp_name,$path_filename_ext);

                $this->obj=json_decode($data, true);
                $this->name=$this->obj["nombre"];
                $this->precio=$this->obj["precio"];
                $this->foto=$path_filename_ext;
                $this->data=[$this->name, $this->precio, $this->foto];
                return $this->model->create($this->data);
            }
        }
    }

    public function read($id=''){

        return $this->model->read($id);
    }

    public function update($data){
       /* Hay 2 maneras de recibir desde getProductsAdmin.js
       1. recibir el formdata adentro con su variable data(un json) la variable $_FILES con la imagen
       2. recibir el formdata pero sin la variable img osea tener en el json la ruta que esta en la BD 
       "cuando no actualizamos imagen" */ 
        //cuando existe la variable $_FILES
        if (($_FILES['foto']['name']!="")){
            $target_dir = "upload/";
            $file = $_FILES['foto']['name'];
            $path = pathinfo($file);
            $filename = $path['filename'];
            $ext = $path['extension'];
            $temp_name = $_FILES['foto']['tmp_name'];
            //nombre directorio/imagen.extension
            $path_filename_ext = $target_dir.$filename.".".$ext;
            
            // Check if file already exists
            //checa si subimos una imagen ya existente para actualizar
        if (file_exists($path_filename_ext)) {
            
            return json_encode(["message"=>"error"]);
            
        }else{
            //si subimos una imagen nueva
            $this->obj=json_decode($data, true); //formdata que me envian
            $this->id=$this->obj["id"];
            $this->imgDb=json_decode($this->model->read($this->id),true); //busco por el id la ruta de la foto en la BD para eliminarla de mi server
            //esta ruta la obtumos gracias a echo $_SERVER['DOCUMENT_ROOT']; y agregamos el /src/e
            $this->route="/storage/ssd5/073/13963073/public_html/src/e-commerce/apiPHP/" . $this->imgDb[0]["foto"]; //ruta para imagen
            unlink($this->route); //borrar imagen

           move_uploaded_file($temp_name,$path_filename_ext); //mover imagen a directorio
            $this->name=$this->obj["nombre"];
            $this->precio=$this->obj["precio"];
            $this->foto=$path_filename_ext;
            $this->data=[$this->name, $this->precio, $this->foto, $this->id];
            return $this->model->update($this->data);
            
        }
    }else{
        //sino recibimos variable $_FILES es porque no queremos actualizar la imagen
        $this->obj=json_decode($data, true); //formdata que me envian
        $this->id=$this->obj["id"];
        $this->name=$this->obj["nombre"];
        $this->precio=$this->obj["precio"];
        $this->foto="upload/".$this->obj["foto"];
        $this->data=[$this->name, $this->precio, $this->foto, $this->id];

        return $this->model->update($this->data);
    }

    
    }

    //borrar producto
    public function delete($id=''){
        $this->id=$id;
        //busco a traves del id la imagen correspondiente al producto para eliminarla del folder
        $this->imgDb=json_decode($this->model->read($this->id),true);
        $this->route="/storage/ssd5/073/13963073/public_html/src/e-commerce/apiPHP/" . $this->imgDb[0]["foto"]; //ruta para imagen
        unlink($this->route); //borrar imagen
        return $this->model->delete($id);
        
    }

    
    //CRUD para tabla Usuarios
    public function createNewUser($data=[]){

        return $this->model->createNewUser($data);
    }

    public function createSession($user=[]){

        $this->user=json_decode($user,true);
        
        if(!empty($this->user)){
           
            session_start();
            $_SESSION["idUser"]=$this->user[0]["idUser"];
            $_SESSION["rol"]=$this->user[0]["rol"];
            $_SESSION["username"]=$this->user[0]["email"];
        }else{
            echo "Error";
        }

    }

    public function loginUser($data=[]){

        return $this->model->loginUser($data);
    }


    //CRUD CARRITO
    public function getCartProducts($data=[]){

       $cartProducts=[];
       
       //un for para el array de ids
       for($i=0; $i < count($data); $i++){
         
        $out=$this->model->read($data[$i]); //llamo funcion para obtener data de la BD a traves del id
        array_push($cartProducts, json_decode($out,true)); //almaceno la fila en el array
       }

       return json_encode($cartProducts);
    }


    public function makepurchase($data=[]){
      
        //separamos en arrays el array data
        $idProduct=$data["id"]; //array con id del producto
        $cantidad=$data["cantidad"]; 
        $user=$data["user"]; //obtenemos campo user
        
        for($i=0; $i < count($idProduct); $i++ ){

          $output=$this->model->makepurchaseandsave($idProduct[$i], $cantidad[$i], $user);
          
        }
        return $output;
    }

    public function readProductsByUser($id=''){
        return $this->model->readProductsByUser($id);
    }

    public function getMyShopping($products=[]){
        
        $myshopping=[];
        for($i=0; $i < count($products); $i++){
            $out=json_decode($this->model->read($products[$i]),true);

            array_push($myshopping, $out);
        }

        return json_encode($myshopping);
    }

}
