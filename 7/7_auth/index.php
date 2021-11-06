<?php
include "main.php";
?>

<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<span>LOG IN</span>

<form action="" method="post">
    <input class="input-mail" type="text" name="login" placeholder = "EMAIL">
    <input class="input-pass" type="password" name="pass" placeholder = "PASSWORD">
    Save? <input type='checkbox' name='save'>
    <input type="submit" name="ok" value = "LOG IN">
</form>


<?php if (isset($_COOKIE["hash"])) {
    ?>
    <script>

        document.querySelector('.input-mail').setAttribute('placeholder', '<?=$_SESSION[login]?>');
        document.querySelector('.input-pass').setAttribute('placeholder', '**********');

    </script>
<?php
}
?>


</body>
</html>