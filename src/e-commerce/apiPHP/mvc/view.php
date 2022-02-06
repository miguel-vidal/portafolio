<?php

//products
require_once("controller.php");

    $view=new Controller();

    function doGET($id=''){
        global $view;
        $output=$view->read($id);
        return $output;
    }

    function doPOST($post){
        global $view;
        $output=$view->create($post);
        return $output;
    }

    function doPUT($data){
        global $view;
        $output=$view->update($data);
        return $output;
        
    }

    function doDELETE($id=''){
        global $view;
        $output=$view->delete($id);
        return $output;
    }



//USER
    function createNewUser($data=[]){
        global $view;
        $output=$view->createNewUser($data);
        return $output;
    }

    function loginUser($data=[]){
     global $view;
     $output=$view->loginUser($data);   
     $view->createSession($output);
     return $output;
    }

//CART
    function getCartProducts($data=[]){
        global $view;
        //el string lo transformo en array separado por comas
        $arrId=explode(",", $data["carrito"]);
        $output=$view->getCartProducts($arrId);
        return $output;
    }

    function makepurchase($data=[]){
       global $view;
       $output=$view->makepurchase($data);
       return $output;
    }

    function readProductsByUser($id=''){
        global $view;
        $output=$view->readProductsByUser($id);
        return $output;
    }

    function getMyShopping($arr=[]){
        global $view;
        $output=$view->getMyShopping($arr);
        return $output;
    }