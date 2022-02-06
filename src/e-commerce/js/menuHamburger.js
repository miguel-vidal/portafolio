let hamburger=document.querySelector(".hamIcon");


//menu hamburguesa
const toggleClass=()=>{
    let menu=document.getElementById("mainMenu");
    menu.classList.toggle("toggleCls");
}

hamburger.addEventListener("click", toggleClass);
