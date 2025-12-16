var usuario = document.getElementById('usuario').value;
var perfil = document.getElementById('perfil_actual').value;
var usuario = document.getElementById('usuario').value;
var botonSeguir = document.getElementById('seguir');

// Función para verificar si el perfil ya está seguido
function verificarSeguido() {
    // Realiza la solicitud al servidor PHP
    fetch('gestionar_seguidores.php?accion=verificar')
        .then((response) => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Error al obtener datos del usuario');
            }
        })
        .then((data) => {
            if (data.seguidos && data.seguidos.includes(parseInt(perfil))) {
                // El perfil ya está seguido
                botonSeguir.className = "dejar-seguir";
                botonSeguir.textContent = 'Dejar de seguir';
                botonSeguir.onclick = dejarSeguir;
            } else {
                // El perfil no está seguido
                botonSeguir.className = "seguir"
                botonSeguir.onclick = guardarPerfilSeguido;
                botonSeguir.textContent = 'Seguir';
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }


function dejarSeguir(){
    console.log("dejar de seguir exitoso")
    if (usuario && perfil) {
        const formData = new FormData();
        formData.append('perfil_id', perfil);

        fetch('gestionar_seguidores.php?accion=dejarDeSeguir', {
            method: 'POST',
            body: formData
        })
            .then((response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Error al dejar de seguir');
                }
            })
            .then((data) => {
                if (data.exito) {
                    console.log('Perfil dejado de seguir correctamente.');
                    verificarSeguido();
                } else {
                    console.error('Error:', data.error);
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    } else {
        console.error('Faltan datos de usuario o perfil.');
        window.open('../inicio_secion/iniciar_secion.php', '_self');
    }
}

function guardarPerfilSeguido() {
    if (usuario && perfil) {
        const formData = new FormData();
        formData.append('perfil_id', perfil);

        fetch('gestionar_seguidores.php?accion=seguir', {
            method: 'POST',
            body: formData
        })
            .then((response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Error al seguir perfil');
                }
            })
            .then((data) => {
                if (data.exito) {
                    console.log('Perfil seguido guardado correctamente.');
                    verificarSeguido();
                } else {
                    console.error('Error:', data.error);
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    } else {
        console.error('Faltan datos de usuario o perfil.');
        window.open('../inicio_secion/iniciar_secion.php', '_self')
    }
}

function leerDatosUsuario() {
    const usuario = document.getElementById('usuario').value;
    if (usuario) {
        // Usa el endpoint PHP del servidor
        fetch('gestionar_seguidores.php?accion=verificar')
            .then((response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Error al obtener datos del usuario');
                }
            })
            .then((data) => {
                if (data.seguidos && data.seguidos.length > 0) {
                    const idsSeguidos = data.seguidos.join(',');
                    obtenerDatosUsuarios(idsSeguidos);
                } else {
                    const followersList = document.getElementById('lista-seguidos');
                    console.log('no hay seguidores');
                    const MensajeItem = document.createElement('span');
                    MensajeItem.textContent = "no sigues a nadie";
                    followersList.appendChild(MensajeItem);
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    } else {
        console.error('Falta el nombre de usuario.');
        window.open('../inicio_secion/iniciar_secion.php', '_self');
    }
}

function obtenerDatosUsuarios(idsSeguidos) {
    fetch('obtener_datos_usuarios.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'ids=' + encodeURIComponent(idsSeguidos)
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('lista-seguidos').innerHTML = data;
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}


function recargar() {
    location.reload;
}
