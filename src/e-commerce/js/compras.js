    let idUser=document.getElementById("iduser");

    const print=(products,data)=>{
        console.log(products)
        let productList=document.getElementById("productList"), output='';
    
        for(let i in data){
            output+=`
            <tr>
            <td><img src="../apiPHP/${data[i][0]['foto']}" width="50px" height="50px"></td>
            <td>${data[i][0]['nombre']}</td>
            <td>${data[i][0]['precio']}</td>
            <td>${products[i]["cantidadProducto"]}</td>
            </tr>
            `;
        }

        productList.innerHTML=output;
    }
    async function myproducts(products){
        
        let idProducts=products.map(product=>{return product.idProducto});
        let url='https://proyectosmavl.000webhostapp.com/src/e-commerce/apiPHP/cart/products';
        const r={
            "method":"POST",
            "url":`${url}`,
            "data":JSON.stringify(idProducts)
        };
        
        const response=await ajax(r);

        switch(response.status){

            case 200:
                let res=JSON.parse(response.response);
                print(products,res);
            break;
            case 400:
                console.log("error");
            break;
        }
    }

    async function myshopping(user){

        let url="https://proyectosmavl.000webhostapp.com/src/e-commerce/apiPHP/cart/myshopping";   
        let titulo=document.getElementById("tituloCompras");
        const r={
            "method":"POST",
            "url":`${url}`,
            "data":JSON.stringify({"id":idUser.value})
        }

        const response=await ajax(r);

        switch(response.status){
            case 200:
                let res=JSON.parse(response.response);
                if(res.length > 0){
                    titulo.innerText="compras realizadas";
                    myproducts(res);
                }else{
                   let productsTableCart=document.getElementById("productsTableCart");
                   productsTableCart.classList.add("hidden");
                   titulo.innerText="Todavia no has realizado compras";
                }
            break;
            case 400:
                console.log("Error");
            break;
        }
        
    }


    document.addEventListener("DOMContentLoaded",()=>{

        myshopping();
    });