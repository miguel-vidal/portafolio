
let LS=localStorage,
btnBuy=document.getElementById("btnBuy"),
btnBuyProducts=document.getElementById("btnBuyProducts"),
productsTableCart=document.getElementById("productsTableCart"),
titleShoppingCart=document.getElementById("titleShoppingCart");

//realizar la compra ya cuando se presiona boton comprar
const makepurchase=async (idproductos, cantidadproductos, iduser)=>{

    let url="https://proyectosmavl.000webhostapp.com/src/e-commerce/apiPHP/productos/comprar";
    //objeto con arrays
    const obj={
        id:idproductos,
        cantidad:cantidadproductos,
        user:iduser
    };
    
    const r={
        "method":"POST",
        "url":`${url}`,
        "data":JSON.stringify(obj)
    };

    const response=await ajax(r);

    switch(response.status){
        case 200:
                let res=JSON.parse(response.response);
                if(res["message"]=="exito"){
                    alert("Compra exitosa");
                    window.location="compras.php";
                    localStorage.clear();
                }else{
                    alert("Hubo un error al momento de comprar intentelo mas tarde.");
                    window.location="../index.php";
                }
        break;
        case 400:
            console.log("Error");
        break;
    }
}


//cuando se presione click en boton comprar dispara el evento
const purchase=idUser=>{

    let result = window.confirm('¿Desea comprar los productos?');

    if(result){
    let idProducto=document.getElementsByClassName("idProducto");
    let idproductos=[];
    let iduser= idUser;
    let cantidad=document.getElementsByClassName("cantidad"); //obtener todos los values de muchos inputs  document.getElementsByClassName
    let cantidadProductos=[];

    //guardamos en un array el valor de cada input almacenado en el input de byclassname
    for(let i=0; i < cantidad.length; i++){
        idproductos.push(idProducto[i].value);
        cantidadProductos.push(cantidad[i].value);
    }

    makepurchase(idproductos, cantidadProductos, iduser);
     
    }else{

        alert("su compra fue cancelada :(");
    }    
}


const checkLS=()=>{
    const productsls=LS.getItem("shopingcart");
    const pro =JSON.parse(productsls);
    return pro;
}


//borrar item de array de localstorage
const deleteItem=id=>{
    const arrLS=checkLS();
    const newArr=[];

    if(arrLS.length > 1){
        for(let i in arrLS){     
            //mientras el id sea diferente al de localstorage lo almacena en nuevo arreglo
            //si el id es igual al de storage no lo almacenara
            if(arrLS[i] != id){
                newArr.push(arrLS[i]);
            }
        }
        LS.removeItem("shopingcart");
        LS.setItem("shopingcart", JSON.stringify(newArr));
        getProducts();
    }else{
        LS.removeItem("shopingcart");
        getProducts();
        setTimeout(()=>{
            location.reload();
        },200);
    }

}

const printCart=data=>{
    
    let productList=document.getElementById("productList"), output='';
  
    for(let i in data){
        output+=`
           <tr>
           <td><img src="../apiPHP/${data[i][0]['foto']}" width="50px" height="50px"></td>
           <td>${data[i][0]['nombre']}</td>
           <td>${data[i][0]['precio']}</td>
           <td><input type="number" min="1" max="100" value="1" class="cantidad"></td>
           <td><button class="drop_from_cart" onClick="deleteItem(${data[i][0]['idProducto']})">X</button></td>
           <td class="hidden"><input class="idProducto" type="hidden" value="${data[i][0]['idProducto']}"></td>
           </tr>
        `;
    }

    productList.innerHTML=output;
        
}

const getProducts=async()=>{

    let url="https://proyectosmavl.000webhostapp.com/src/e-commerce/apiPHP/productos/carrito";
    const products=checkLS();
    if(products){
        titleShoppingCart.innerText="CARRITO DE COMPRAS";
        const body=JSON.stringify({"carrito":`${products}`});
        const r={
            "method":"POST",
            "url":`${url}`,
            "data":`${body}`
        };
        const response=await ajax(r);
    
        switch(response.status){
    
            case 200:
                let res=JSON.parse(response.response);
                printCart(res);
            break;
            case 400:
                console.log("error");
            break;
        }
    
    }else{
        btnBuyProducts.classList.add("hidden");
        productsTableCart.classList.add("hidden");
        titleShoppingCart.innerText="NO HAY PRODUCTOS SELECCIONADOS EN EL CARRITO";
    }

}


document.addEventListener("DOMContentLoaded",()=>{

    getProducts();
});

