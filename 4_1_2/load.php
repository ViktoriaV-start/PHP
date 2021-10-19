<?php

$messages = [
    'OK' => 'File is uploaded',
    'ERROR' => 'Error',
];

if (isset($_FILES['myfile'])) {
    $path = "img_loaded/" . $_FILES['myfile']['name'];
}

if($_FILES["myfile"]["size"] > 1024*5*1024)
    {
        echo ("<div class='container browse__text'>File's size should be less than 5MB</div>");
        exit;
    }

$imageInfo = getimagesize($_FILES['myfile']['tmp_name']);
if(getimagesize($_FILES['myfile']['tmp_name'])
    && $imageInfo['mime'] != 'image/gif'
    && $imageInfo['mime'] != 'image/jpeg'
    && $imageInfo['mime'] != 'image/png'
    && $imageInfo['mime'] != 'image/svg+xml')
{
    echo "Можно загружать только jpg, gif png, svg -файлы, неверное содержание файла, не изображение";
    exit;
}

if($_FILES['myfile']['type'] && $_FILES['myfile']['type'] != "image/jpeg"
    && $_FILES['myfile']['type'] != 'image/gif'
    && $_FILES['myfile']['type'] != 'image/jpeg'
    && $_FILES['myfile']['type'] != 'image/png'
    && $_FILES['myfile']['type'] != 'image/svg+xml')
{
    echo "Можно загружать только jpg, gif png, svg -файлы, неверное содержание файла, не изображение";
    exit;
}

if (move_uploaded_file($_FILES['myfile']['tmp_name'], $path)) {
   $message = "Файл загружен!";
   echo "<div class='container'><img src=$path alt ='client' width='200'><span class='browse__text'>$message</span></div>";
   header("Location: /?message=OK");
   die();

} else {
   $message = "Файл не загружен";
   echo "<div class='container'>$message</div>";
   header("Location: /?message=ERROR");
   die();

};

$message = $messages[$_GET['message']];
include 'index.php';
?>