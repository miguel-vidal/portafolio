<?php

require_once("mvc/view.php");

if(isset( $_GET["url"] )){

    $url=$_GET["url"];
    $numero = intval(preg_replace('/[^0-9]+/','',$url),10);

    if($_SERVER["REQUEST_METHOD"] == "GET"){

        switch($url){

            case "productos":
                $output=doGET();
                print_r($output);
                http_response_code(200);
            break;

            case "product/$numero";
                //print_r(json_encode(["num"=>"$numero"]));
                $output=doGET($numero);
                print_r($output);
                http_response_code(200);
            break;
        }

    } //if request get
    else if($_SERVER["REQUEST_METHOD"] == "POST"){

        $postBody=file_get_contents("php://input");
        $convert=json_decode($postBody, true);

        

            switch($url){
                
                case "insertproducts":
                    $output=doPOST($_POST["data"]);
                    print_r($output);
                    http_response_code(200);
                break;
                case "insertnewuser":
                $output=createNewUser($convert);
                print_r($output);
                http_response_code(200);
                break;

                case "loginuser":
                    //print_r(json_encode($convert));
                    $output=loginUser($convert);   
                    print_r($output);
                    http_response_code(200);
                break;
                case "actualizarProducto":
                   // print_r(json_encode(["data"=>$_POST["data"]]));
                    $output=doPUT($_POST["data"]);
                    print_r($output);
                    http_response_code(200);
                break;

                case "eliminarProducto":
                    $id=$convert["id"]; //obtengo de convert el json y extraigo propiedad ["id"]
                    $output=doDELETE($id);
                    print_r($output);
                    http_response_code(200);
                break;

                //Carrito
                case "productos/carrito":
                   $output=getCartProducts($convert);
                   print_r($output);
                   http_response_code(200);
                break;

                case "productos/comprar":
                    $output=makepurchase($convert);
                    print_r($output);
                    http_response_code(200);
                break;
                case "cart/myshopping":
                    $output=readProductsByUser($convert["id"]);
                    print_r($output);
                    http_response_code(200);
                break;
                case "cart/products":
                    $output=getMyShopping($convert);
                    print_r($output);
                    http_response_code(200);
                break;
            }

        
    } //request method post

} //if url
else{

    echo "<code>
    GET productos /
    </code>";
}