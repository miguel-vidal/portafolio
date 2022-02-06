let formProducts =document.getElementById("formProducts");


const saveProduct=async (e)=>{
    e.preventDefault();
    const obj={ 
    nombre:document.getElementById("nombre").value,
    precio:document.getElementById("precio").value,
    foto:document.getElementById("foto").files[0]
    };

    let out=JSON.stringify(obj);
    
       
    let url="https://proyectosmavl.000webhostapp.com/src/e-commerce/apiPHP/insertproducts";
    
    const r={
        "method":"POST",
        "url":`${url}`,
        data:new FormData(formProducts)
    };
    
    r.data.append("data", out);
    const response=await formdata(r);
    
    switch(response.status){
        case 200:
            let res=JSON.parse(response.response);
            if(res["message"] == "exito"){
                alert("Producto añadido correctamente");
                window.location="./productos.php";
            }else{
                alert(res["message"]);
            }
            break;
        case 400:
            console.log("error");
        break;
    }
}




formProducts.addEventListener("submit", saveProduct);