<?php
// Verificar si se ha enviado el formulario
if(isset($_POST["submit"])) {
    $target_dir = "uploads/"; // Directorio donde se guardarán los archivos cargados
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); // Ruta completa del archivo cargado

    // Mueve el archivo cargado a la carpeta 
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded successfully.";
    } else {
        echo "Lo siento, hubo un error al subir tu archivo.";
    }
}
?>

