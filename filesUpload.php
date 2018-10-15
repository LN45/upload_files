<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Files upload</title>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

<div>
    <?php
    $it = new FilesystemIterator('upload/'); // pour lister les fichiers dans le dossier upload

    //$it ressort le nom de l'image
    foreach ($it as $fileinfo) :;?>
            <div class="img-thumbnail">
                <img src="upload/<?=$it?>" height="352" width="470">
                 <div>
                     <h3><?= $it ?></h3>
                     <form action="" method="post" role="form">
                        <input type="hidden"  name="deleteImage" value="<?=$it?>" >
                        <input type="submit" class="btn-danger" name="delete" value="delete">
                     </form>
                 </div>
             </div>
<?php endforeach?>
</div>

<?php
$file_destination = 'upload/';

if(isset($_POST['deleteImage'])){
    unlink($file_destination.$_POST['deleteImage']);
    header('Location: filesUpload.php');
}
