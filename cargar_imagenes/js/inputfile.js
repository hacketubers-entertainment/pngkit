var inputArchivo = document.getElementById('imageUpload');
const imageUpload = document.getElementById('imageUpload'); 
const folderName = document.getElementById('folderName'); 
const nombreImagen = document.getElementById('nombre_imagen'); 
const descripcionImagen = document.getElementById('descripcion_imagen'); 
const uploadButton = document.getElementById('uploadButton'); 
function checkFormFields() { 
    if (imageUpload.files.length > 0 && folderName.value !== "" && nombreImagen.value.trim() !== "" && descripcionImagen.value.trim() !== "") {
         uploadButton.disabled = false;
         uploadButton.innerHTML = 'Subir imagen';
        } else {
            uploadButton.innerHTML = 'Rellena todos los campos';
            uploadButton.disabled = true; 
        } 
    } 
imageUpload.addEventListener('change', checkFormFields); 
folderName.addEventListener('change', checkFormFields); 
nombreImagen.addEventListener('input', checkFormFields); 
descripcionImagen.addEventListener('input', checkFormFields);

inputArchivo.addEventListener("change", function() {
    let archivo = this.files[0];
    let nombreArchivo = archivo.name;
    let labelArchivo = document.getElementById('labelarchivo');
    let imagenSeleccionada = document.getElementById('imagen_seleccionada');

    if (this.value != "") {
        // Crear una URL temporal para la imagen seleccionada
        let urlImagen = URL.createObjectURL(archivo);
        imagenSeleccionada.src = urlImagen;
        labelArchivo.innerHTML = nombreArchivo;
    } else {
        labelArchivo.innerHTML = 'Selecciona un archivo';
    }
});
