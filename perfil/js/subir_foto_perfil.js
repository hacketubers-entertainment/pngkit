var folderName = document.getElementById('id-user').value;
var progreso1 = document.getElementById("progreso_carga_perfil");
document.getElementById('subir_perfil').addEventListener('click', function() {
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
    var imageFile = document.getElementById('input_perfil').files[0];
    var storageRef = storage.ref('fotos de perfil/' + folderName + '/' + imageFile.name);
    var uploadTask = storageRef.put(imageFile);

    uploadTask.on('state_changed', function(snapshot) {
        var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
        progreso1.innerHTML = "El progreso de la carga es: " + progress.toFixed(0);
        switch (snapshot.state) {
            case firebase.storage.TaskState.PAUSED:
                progreso1.innerHTML = "la carga esta pausada";
                break;
            case firebase.storage.TaskState.RUNNING:
                console.log('La carga está en curso');
                break;
        }
    }, function(error) {
        console.log(error);
    }, function() {
        progreso1.innerHTML = "subida completada";
        console.log('Subida completada');
        uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
            console.log('URL de descarga:', downloadURL);
            fetch('guardar_imagen_perfil.php?id=' + folderName +'&enlace=' + encodeURIComponent(downloadURL))
                .then(response => response.text())
                .then(data => console.log(data))
                .catch(error => console.error('Error:', error));
                recargar();
        });
    });
});
function recargar(){
    location.reload();
}