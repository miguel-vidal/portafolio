let shoppingcart=document.getElementById("shopingcart"),
btnAddCart=document.getElementById("btnAddCart"),
LS=localStorage,
cartLS=[];


const shoopingCart=()=>{

    window.location='pages/shoppingcart.php';
}

//checar localstorage
const checkLS=()=>{
    //buscar variable
    const productsls=LS.getItem("shopingcart");
    const pro =JSON.parse(productsls);
    return pro;
}

//agregar productos al carrito en ls
//recibo el this, y el id
const cart=(event,id)=>{

    //save in localstorage
    const products=checkLS();

    //checa en Localstorage si la variable products existe
    //si no existe variable shopingcart la crea
    if(!products){
        cartLS.push(id);   
        LS.setItem("shopingcart", JSON.stringify(cartLS));
        shoppingcart.innerText='';
        shoppingcart.innerText=`${cartLS.length}`;
    }else{
        products.push(id);   
        LS.setItem("shopingcart", JSON.stringify(products));
        shoppingcart.innerText='';
        shoppingcart.innerText=`${products.length}`;
    }
    //añadimos clase a boton
    event.classList.add("button-disabled");
}

const cartIcon=()=>{
    const pro=checkLS();
    (pro) ? shoppingcart.innerText=`${pro.length}` : null;
}



//Events
document.addEventListener("DOMContentLoaded", ()=>{
    cartIcon();

});
