document.getElementById('crear_carpeta').addEventListener('click', function(e) {
    e.preventDefault();
    var modo = document.getElementById('input_modo').value;
    var link = document.createElement('link');
    link.rel = 'stylesheet';

    console.log(modo);
    if(modo){
        link.href = '../css/modo_oscuro/superposicion.css';
    }else{
        link.href = '../css/superposicion.css';
    }
    document.head.appendChild(link);

    var overlay = document.createElement('div');
    overlay.className = 'overlay';
    document.body.appendChild(overlay);

    var contenedorFormulario = document.getElementById('contenedorFormulario');
    contenedorFormulario.innerHTML = `
        <form method="POST" action="crear_carpeta.php" id="miFormulario" class="formulario-superpuesto">
            <h3 id="h2_formulario_crearcarpeta">Crea una carpeta</h3>
            <input name="nombre_carpeta" type="text" placeholder="Nombre de la carpeta">
            <input name="estilo" type="text" placeholder="Estilo o Tecnica usada">
            <div id="div2botones">
            <input class="boton_crear_carpeta" type="submit" value="Crear">
            <button type="button" id="volverNormal">cancelar</button>
            </div>
        </form>
    `;

    // Añadir el evento al botón dentro del formulario
    document.getElementById('volverNormal').addEventListener('click', function() {
        var form = document.getElementById('miFormulario');
        form.classList.remove('formulario-superpuesto');
        form.remove();
        if(modo){
            var link = document.querySelector('link[href="../css/modo_oscuro/superposicion.css"]');
        }else{
            var link = document.querySelector('link[href="../css/superposicion.css"]');
        }
        if (link) {
            link.parentNode.removeChild(link);
        }
    });
});

