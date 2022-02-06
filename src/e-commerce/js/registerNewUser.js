let registerNewUser=document.getElementById("registerForm");

//registrar un nuevo usuario
async function postNewUser(e){

    e.preventDefault();

    //funcion para convertir formdata a json, le pasamos el formdata
    let body=format_json(1, registerNewUser, 0);
    
    let url="https://proyectosmavl.000webhostapp.com/src/e-commerce/apiPHP/insertnewuser";
    const r={
        "method":"POST",
        "url":`${url}`,
        "data":`${body}`
    }
    const response=await ajax(r);

    switch(response.status){
        case 200:
            let res=JSON.parse(response.response);
            console.log(res);
            registerNewUser.reset();
            alert("Cuenta creada exitosamente");

            window.location="login.php";
        break;
        case 400:
            console.log("error al insertar nuevo usuario");
        break;
    }
}



registerNewUser.addEventListener("submit", postNewUser); //Evento de formulario del registro