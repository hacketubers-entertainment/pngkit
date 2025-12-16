var usuario = document.getElementById('usuario').value;
var perfil = document.getElementById('perfil_actual').value;
var usuario = document.getElementById('usuario').value;
var botonSeguir = document.getElementById('seguir');

// Función para verificar si el perfil ya está seguido
function verificarSeguido() {
    // Realiza la solicitud para obtener los datos del usuario
    fetch(`https://pngkit-5b951-default-rtdb.firebaseio.com/seguidores/${usuario}.json`)
        .then((response) => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Error al obtener datos del usuario');
            }
        })
        .then((data) => {
            if (data && data.perfilesSeguidos) {
                if (data.perfilesSeguidos.includes(perfil)) {
                    // El perfil ya está seguido
                    botonSeguir.className = "dejar-seguir";
                    botonSeguir.textContent = 'Dejar de seguir';
                    botonSeguir.onclick = dejarSeguir;
                    location.reload;
                    recargar();
                } else {
                    // El perfil no está seguido
                    botonSeguir.className = "seguir"
                    botonSeguir.onclick = guardarPerfilSeguido;
                    botonSeguir.textContent = 'Seguir';
                    location.reload;
                    recargar();
                }
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }


function dejarSeguir(){
    console.log("dejar de seguirr exitoso")
    if (usuario && perfil) {
        const url = `https://pngkit-5b951-default-rtdb.firebaseio.com/seguidores/${usuario}.json`;

        // Obtener datos actuales del usuario
        fetch(url)
            .then((response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Error al obtener datos del usuario');
                }
            })
            .then((data) => {
                const perfilesSeguidos = data ? data.perfilesSeguidos || [] : [];

                // Eliminar el perfil de la lista
                const nuevosPerfilesSeguidos = perfilesSeguidos.filter(p => p !== perfil);

                // Actualizar datos en la base de datos
                return fetch(url, {
                    method: 'PATCH',
                    body: JSON.stringify({ perfilesSeguidos: nuevosPerfilesSeguidos })
                });
            })
            .then(() => {
                verificarSeguido();
                console.log('Perfil seguido eliminado correctamente.');
                location.reload();
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
        const url = `https://pngkit-5b951-default-rtdb.firebaseio.com/seguidores/${usuario}.json`;

        // Realiza la solicitud para obtener los datos actuales del usuario
        fetch(url)
            .then((response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Error al obtener datos del usuario');
                }
            })
            .then((data) => {
                // Agrega el perfil seguido a la lista existente o crea una nueva lista
                const perfilesSeguidos = data ? data.perfilesSeguidos || [] : [];
                perfilesSeguidos.push(perfil);

                // Actualiza los datos en la base de datos
                return fetch(url, {
                    method: 'PATCH',
                    body: JSON.stringify({ perfilesSeguidos })
                });
            })
            .then(() => {
                verificarSeguido();
                console.log('Perfil seguido guardado correctamente.');
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
        // URL de la base de datos de Firebase
        const url = `https://pngkit-5b951-default-rtdb.firebaseio.com/seguidores/${usuario}/perfilesSeguidos.json`;

        // Realiza la solicitud para obtener los datos del usuario
        fetch(url)
            .then((response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Error al obtener datos del usuario');
                }
            })
            .then((data) => {
                if (data) {
                    const idsSeguidos = Object.values(data).join(',');
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
