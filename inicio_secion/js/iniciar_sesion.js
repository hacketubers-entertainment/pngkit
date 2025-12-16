let crearcuenta = document.getElementById("crearcuenta");
let iniciosesion = document.getElementById("iniciosecion");
let formulario = document.getElementById("formulario")
let title = document.getElementById("title");
let nameinput = document.getElementById("name-input");
var contadorclicksregistro = 2;
var contadorclicksinicio = 0;

iniciosesion.onclick = function () {
    contadorclicksregistro = 0;
    contadorclicksinicio = contadorclicksinicio + 1;
    nameinput.style.maxHeight = "0";
    title.innerHTML = "Login";
    crearcuenta.classList.add("disable");
    iniciosesion.classList.remove("disable");
    crearcuenta.setAttribute("type", "submit");
    iniciosesion.setAttribute("type", "button");
    if(contadorclicksinicio > 1){
        formulario.action = "iniciar.php"
        iniciosesion.setAttribute("type", "submit");
        console.log("inicio"+contadorclicksinicio);
    }
}

crearcuenta.onclick = function () {
    contadorclicksinicio = 0;
    contadorclicksregistro = contadorclicksregistro + 1;
    nameinput.style.maxHeight = "60px";
    title.innerHTML = "Registro";
    crearcuenta.classList.remove("disable");
    iniciosesion.classList.add("disable");
    iniciosesion.setAttribute("type", "submit");
    crearcuenta.setAttribute("type", "button");
    if(contadorclicksregistro > 1){
        formulario.action = "registrar.php"
        crearcuenta.setAttribute("type", "submit");
        console.log("registro"+contadorclicksregistro);
    }
}

