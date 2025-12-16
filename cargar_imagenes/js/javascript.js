var title = document.getElementById("nombre");
var progreso = document.getElementById("estado-subida");
var id;
var nombre;

fetch('../inicio_secion/get_id.php')
.then(response => response.json())
.then(data => {
    id = data.id;
    nombre = data.nombre;
    title.innerHTML = nombre;
    console.log(nombre);
    console.log(id);

    if (id && nombre) {
        document.getElementById('uploadButton').addEventListener('click', function() {
            var firebaseConfig = {
                apiKey: "AIzaSyDpTy2C-f1obnJTSbDI2rMNlX7Wngvd5O0",
                authDomain: "pngkit-5b951.firebaseapp.com",
                projectId: "pngkit-5b951",
                storageBucket: "pngkit-5b951.appspot.com",
                messagingSenderId: "731443966343",
                appId: "1:731443966343:web:2f49bbee53422014d2a322",
                measurementId: "G-J6HMPH5YT6"
            };

            firebase.initializeApp(firebaseConfig);
            var storage = firebase.storage();

            var imageFile = document.getElementById('imageUpload').files[0];
            var folderName = document.getElementById('folderName').value;

            document.getElementById('folderName').addEventListener('change', function() {
                var selectedValue = this.value;
                console.log('Nueva carpeta seleccionada ID: ', selectedValue);
            });
            var nombre_imagen = document.getElementById('nombre_imagen').value;
            var descripcion = document.getElementById('descripcion_imagen').value;
            var storageRef = storage.ref('imagenes/usuario' + id + '/' + folderName + '/' + imageFile.name);
            var uploadTask = storageRef.put(imageFile);

            uploadTask.on('state_changed', function(snapshot) {
                var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                progreso.innerHTML = "El progreso de la carga es: " + progress.toFixed(0);
                switch (snapshot.state) {
                    case firebase.storage.TaskState.PAUSED:
                        progreso.innerHTML = "la carga esta pausada";
                        break;
                    case firebase.storage.TaskState.RUNNING:
                        console.log('La carga está en curso');
                        break;
                }
            }, function(error) {
                console.log(error);
            }, function() {
                progreso.innerHTML = "subida completada";
                console.log('Subida completada');
                uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
                    console.log('URL de descarga:', downloadURL);
                    fetch('guardar_imagen.php?id=' + id + '&usuario=' + id + '&nombre_imagen=' + nombre_imagen + '&descripcion=' + descripcion + '&nombrecarpeta=' + encodeURIComponent(folderName) + '&enlace=' + encodeURIComponent(downloadURL))
                        .then(response => response.text())
                        .then(data => {
                            console.log(data);
                            window.open('../index.php', '_self');
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    } else {
        document.getElementById('uploadButton').addEventListener('click', function() {
            window.open('../inicio_secion/iniciar_secion.php', '_self')
            progreso.innerHTML = "Inicie Secion Por Favor";
        });
    }
})
.catch(error => console.error('Error:', error));
