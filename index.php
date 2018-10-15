<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Multiple file upload</title>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="files[]" multiple />
    <input type="submit" value="Send" />
</form>

<?php
if (!empty($_FILES['files']['name'][0])){
    $files = $_FILES['files'];
    $uploaded = array();
    $failed = array();
    $allowed = array('jpg', 'png', 'gif'); //extensions autorisées

    //pour chaque fichier uploadés, on boucle dessus
    foreach ($files['name'] as $position => $file_name) {
        $file_tmp = $files['tmp_name'][$position]; // nom temporaire du fichier
        $file_size = $files['size'][$position]; // taille du fichier
        $file_error = $files['error'][$position];
        $file_ext = explode('.',$file_name); // pour avoir extension
        $file_ext = strtolower(end($file_ext)); // pour avoir extension

        // si l'extension est ok
        if(in_array($file_ext,$allowed)){

            //si pas d'erreur
            if ($file_error === 0) {

                // on vérifie la taille <1mo
                if ($file_size <= 1048576){
                    $file_name_new = uniqid('image').'.'.$file_ext; // nouveau nom du fichier
                    $file_destination = 'upload/'.$file_name_new; // destination dossier

                    // on enregistre le fichier dans le fichier de destination
                    if (move_uploaded_file($file_tmp,$file_destination)){
                        $uploaded[$position] = $file_destination;
                        echo 'le ou les fichiers ont bien été uploadés !';
                        header('Location: filesUpload.php');

                    }else{
                        $failed[$position] = "[{$file_name}] failed to upload.";
                        echo 'le ou les fichiers n\'ont pas été uploadés.';
                    }
                }else{
                    $failed[$position] = "[{$file_name}] is too large.";
                    echo 'le ou les fichiers sont trop volumineux !';
                }
            }else{
                $failed[$position] = "[{$file_name}] errored with code {$file_error}";
                echo 'erreur, impossible d\'upoader.';
            }
        }else{
            $failed[$position] = "[{$file_name}] file extension '{$file_ext}' is not allowed.";
            echo 'Seules les extensions jpg, png et gif sont autorisées !';
        }
    }
}
?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</htm
