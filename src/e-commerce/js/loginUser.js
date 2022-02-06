let formLogin=document.getElementById("formLogin");

//login user
async function loginUser(e){

    e.preventDefault();
    
    let body=format_json(1,formLogin,0);

    let url="https://proyectosmavl.000webhostapp.com/src/e-commerce/apiPHP/loginuser";
    const r={
        "method" : "POST",
        "url" : `${url}`,
        "data" : `${body}`
    }
   
    const response=await ajax(r);

    switch(response.status){

        case 200:
            let res=JSON.parse(response.response);
            
            if(res !== ""){
                //si rol es 1 quiere decir que es admin, : sino es usuario normal
                (res[0]["rol"] == "1") ? window.location="admin.php" : window.location="../index.php";
                localStorage.clear(); 
            }else{
                console.log("no existe el usuario");
            }
            
            break;
        case 400:
            console.log("Error");
            break;
    }
}


formLogin.addEventListener("submit", loginUser); //Evento cuando hace login el usuario