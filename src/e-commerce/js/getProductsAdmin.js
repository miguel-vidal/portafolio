

let formEdit =document.getElementById("formEdit"),
productData;


const deleteProduct=async (id)=>{

    let result=window.confirm("Seguro que desea eliminar este producto?");
    if(result){
        let body=format_json(3,0,id);
        let url=`https://proyectosmavl.000webhostapp.com/src/e-commerce/apiPHP/eliminarProducto`;
        const r={
            "method":"post",
            "url":`${url}`,
            "data":`${body}`
        };

        const response=await ajax(r);

        switch(response.status){
            case 200:
                let res=JSON.parse(response.response);
                (res["message"] == "exito") ?  listProducts() : alert("No se pudo eliminar");
                break;
            case 400:
                console.log("Error");
                break;    
        }
    }else{
        return
    }
}

//actualizar producto
const form= async(e)=>{

    e.preventDefault();    
    let img; 
    
    if(imgEdit.value != ""){
        img=document.getElementById("imgEdit").files[0];
    
    }else{
         img=productData[0]["foto"].slice(7);
    }

    const obj={
        id:document.getElementById("id").value,
        nombre:document.getElementById("nombreEdit").value,
        precio:document.getElementById("priceEdit").value,
        foto:img
    }

    let out=JSON.stringify(obj);
    console.log(out);
    
    let url=`https://proyectosmavl.000webhostapp.com/src/e-commerce/apiPHP/actualizarProducto`;
    
    const r={
        "method":"POST",
        "url":`${url}`,
        data:new FormData(formEdit)
    };

    r.data.append("data", out);
    const response=await formdata(r);

    switch(response.status){

        case 200:
            let res=JSON.parse(response.response);
            if(res["message"] =="exito"){
                listProducts();
            }
            if(res["message"] == "error"){
                alert("Esa imagen ya existe, escoge otra");
            }
            break;
        case 400:
            console.log("Error");
            break;
    }

    
}

//imprimir datos en el formulario para editar
const printForm=data=>{
    formEdit.classList.remove("hidden");
    productData=data;
    let id=document.getElementById("id"),
    nombre=document.getElementById("nombreEdit"),
    price=document.getElementById("priceEdit"),
    imgEdit=document.getElementById("imgEdit"),
    divimg=document.getElementById("imgFormEdit"),
    divImgFormEdit=document.getElementById("divImgFormEdit");

    id.value=data[0]["idProducto"];
    nombre.value=data[0]["nombre"];
    price.value=data[0]["precio"];
    divImgFormEdit.classList.remove("hidden");
    divImgFormEdit.classList.add("visible");
    divimg.src=`../apiPHP/${data[0]["foto"]}`;
    
}
//formulario que pondra la informacion del id a editar para posteriormente actualizar en BD
const getById= async (id)=>{
    
    let url=`https://proyectosmavl.000webhostapp.com/src/e-commerce/apiPHP/product/${id}`;

    const r={
        "method":"GET",
        "url":`${url}`
    };

    const response = await ajax(r);

    switch(response.status){
        case 200:
            let res=JSON.parse(response.response);
            printForm(res);
            break;
        case 400:
            console.log("error");
            break;
    }
}

const print=data=>{
    let productList=document.getElementById("productList"), output='';
    
    console.log(data);
    data.map(product=>{
        output+=`
           <tr>
           <td>${product.nombre}</td>
           <td>${product.precio}</td>
           <td><img src="../apiPHP/${product.foto}" width="50px" height="50px"></td>
           <td><button onclick="getById('${product.idProducto}')">Actualizar</button></td>
           <td><button onclick="deleteProduct('${product.idProducto}')">Eliminar</button></td>
           </tr>
        `;
    });

    productList.innerHTML=output;
}

async function listProducts(){
    let url="https://proyectosmavl.000webhostapp.com/src/e-commerce/apiPHP/productos";

    const r={
        "method":"GET",
        "url":`${url}`
    };

    const response=await ajax(r);

    switch(response.status){
        case 200:
            let res=JSON.parse(response.response);
            print(res);
            
            break;
        case 400:
            console.log("error");
            break;
    }
}


formEdit.addEventListener("submit", form);
document.addEventListener("DOMContentLoaded", ()=>{listProducts();});


