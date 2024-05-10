<?php
// Verificar si se ha enviado el formulario y si se ha seleccionado un archivo
if(isset($_POST["submit"]) && isset($_FILES["fileToUpload"])) {
    // Directorio donde se guardarán los archivos cargados (debes asegurarte de que este directorio exista y tenga los permisos adecuados)
    $target_dir = "uploads/";

    // Obtener información del archivo subido
    $file_name = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $file_name;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Obtener el tipo MIME del archivo subido
    $file_mime_type = mime_content_type($_FILES["fileToUpload"]["tmp_name"]);

    // Validar el tipo de archivo permitido por extensión
    $allowed_file_types = array("jpg", "jpeg", "png", "gif", "pdf", "docx"); // Tipos de archivo permitidos por extensión
    if (!in_array($file_type, $allowed_file_types)) {
        echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG, GIF, PDF y DOCX.";
        exit();
    }

    // Validar el tipo de archivo permitido por tipo MIME
    $allowed_mime_types = array("image/jpeg", "image/png", "image/gif", "application/pdf", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"); // Tipos de archivo permitidos por tipo MIME
    if (!in_array($file_mime_type, $allowed_mime_types)) {
        echo "Lo siento, el tipo de archivo no está permitido.";
        exit();
    }

    // Limitar el tamaño del archivo (en bytes)
    $max_file_size = 5000000; // 5 MB
    if ($_FILES["fileToUpload"]["size"] > $max_file_size) {
        echo "Lo siento, el tamaño del archivo es demasiado grande. El tamaño máximo permitido es de 5 MB.";
        exit();
    }

    // Generar un nombre único para el archivo
    $unique_file_name = uniqid() . "_" . $file_name;

    // Mover el archivo cargado al directorio de destino con un nombre único
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $unique_file_name)) {
        echo "El archivo " . htmlspecialchars($file_name) . " ha sido subido exitosamente.";
    } else {
        echo "Lo siento, hubo un error al subir tu archivo.";
    }
}
?>
