<?php

error_reporting(-1);
$arg1 = 0;
$arg2 = 0;
$result = 0;
$operation = '';

if (isset($_GET['arg1']) && isset($_GET['arg2'])) { // это когда уже получили данные, тогда и обрабатываем
    $arg1 = (int)$_GET['arg1'];
    $arg2 = (int)$_GET['arg2'];
    $operation = $_GET['operation'];
    $result = mathOperation($arg1, $arg2, $operation);
}

function sum($x, $y) {
    return $x + $y;
}
function dif($x, $y) {
    return $x - $y;
}
function mult($x, $y) {
    return $x * $y;
}

function division($x, $y) {
    if ($y == 0) {

        return "ОШИБКА: нельзя делить на ноль";
    } else {
        return round(($x / $y), 2);
    }

}

function mathOperation($arg1, $arg2, $operation) {
    switch ($operation) {
        case "+":
            return sum($arg1, $arg2);
            break;
        case "-":
            return dif($arg1, $arg2);
            break;
        case "*":
            return mult($arg1, $arg2);
            break;
        case "/":
            return division($arg1, $arg2);
            break;
    }
}

// Подключение к ДБ
$db = mysqli_connect('localhost:8889', 'root', 'root', 'brand_shop');
if (!$db) {
    die('db error ' . mysqli_connect_error());
}
$message = '';
$row = [];
$btnText = "Add";
$action = "add";
$messages = [
    'OK' => 'Review is added',
    'DELETE' => 'Review is deleted',
    'EDIT' => 'Review is changed',
    'ERROR' => 'Error'
];
$regExp = '/^ *$/';

if ($_GET['action'] == 'edit') {
    $id = (int)$_GET['id'];

    // обратиться к одному определенному сообщению в таблице reviews
    $answer = mysqli_query($db, "SELECT * FROM reviews WHERE id = {$id}");


    // проверить, что есть ответ (если, например, неправильно передан id)
    //  и далее вытащить запись
    if ($answer) $row = mysqli_fetch_assoc($answer);

    $btnText = "Edit";
    $action = "save";
}

if ($_GET['action'] == 'save') {
    $id = (int)$_POST['id'];
    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['name'])));
    $review = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['review'])));

    if ($review == null || preg_match($regExp, $review)) {
        header('Location: /?message=ERROR');
        die();
    }
    if ($name == null || preg_match($regExp, $name)) {
        $name = "Guest";
    }
    $sql = "UPDATE reviews SET name='{$name}', review='{$review}' WHERE id = {$id}";
    mysqli_query($db, $sql);


    header('Location: /?message=EDIT');
//    header здесь делается чтобы после добавления новости очистить форму
}

if ($_GET['action'] == 'delete') {
    $id = (int)$_GET['id'];

    // обратиться к одному определенному сообщению в таблице reviews
    mysqli_query($db, "DELETE FROM reviews WHERE id = {$id}");

    $btnText = "Delete";
    header('Location: /?message=DELETE');
    die();
}

// ДОБАВЛЕНИЕ ДАННЫХ С ПРОВЕРКОЙ НА БЕЗОПАСНОСТЬ
if ($_GET['action'] == 'add') {

    // УБРАТЬ ТЭГИ (ПЛЮС ДОБАВИТЬ КАВЫЧКИ ГДЕ НУЖНО) - эти применяется к данным, которые вводит пользователь
    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['name'])));


    $review = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['review'])));

    if ($review == null || preg_match($regExp, $review)) {
        header('Location: /?message=ERROR');
        die();
    }
    if ($name == null || preg_match($regExp, $name)) {
        $name = "Guest";
    }

// Вставить новые данные в таблицу
    $sql = "INSERT INTO reviews(name, review) VALUES ('{$name}','{$review}')";
    mysqli_query($db, $sql);

    header('Location: /?message=OK');
    die();
}
// Подгрузить данные из таблицы
$reviews = mysqli_query($db, "SELECT * FROM `reviews`");


if (isset($_GET['message'])) {
    $message = $messages[$_GET['message']];
}
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<div>ПЕРВЫЙ КАЛЬКУЛЯТОР</div>
<form operation="" method="get">
    <input type="text" name="arg1" value = "<?=$arg1?>">

    <select name = "operation" required>
        <option value = "">Choose</option>
        <option <?php if ($operation == '+') echo 'selected'?> value = "+">+</option>
        <option <?php if ($operation == '-') echo 'selected'?> value = "-">-</option>
        <option <?php if ($operation == '/') echo 'selected'?> value = "/">/</option>
        <option <?php if ($operation == '*') echo 'selected'?> value = "*">*</option>
    </select>

    <input type="text" name="arg2" value = "<?=$arg2?>">

    <button type="submit">=</button>
    <input type="text" name="result" readonly value = "<?=$result?>" style = "width: 300px">
</form>
<br><br>
<div>ВТОРОЙ КАЛЬКУЛЯТОР</div>
<form operation="" method="get">

    <input type="text" name="arg1" value = "<?=$arg1?>">
    <div>
        <button name = "operation" type="submit" value = "+" <?php if ($operation == '+') { ?>style = "color: red"<?php } ?>>+</button>
        <button name = "operation" type="submit" value = "-" <?php if ($operation == '-') { ?>style = "color: red"<?php } ?>>-</button>
        <button name = "operation" type="submit" value = "/" <?php if ($operation == '/') { ?>style = "color: red"<?php } ?>>/</button>
        <button name = "operation" type="submit" value = "*" <?php if ($operation == '*') { ?>style = "color: red"<?php } ?>>*</button>

    </div>


    <input type="text" name="arg2" value = "<?=$arg2?>">

    <button type="submit">=</button>
    <input type="text" name="result" readonly value = "<?=$result?>" style = "width: 300px">
</form>


<h2>Отзывы</h2>
<?=$message?>
<form method="post" action="?action=<?=$action?>">
    <!--   метод пост, чтобы гарантированно поместился отзыв-->

    <!--   Скрытый id сообщения, чтобы в обработчике иметь к нему доступ-->
    <input type="text" name="id" value="<?=$row['id']?>" hidden>

    <input type="text" name="name" value="<?=$row['name']?>"><br>
    <input type="text" name="review" value="<?=$row['review']?>"><br>
    <input type="submit" value="<?=$btnText?>">

</form>
<br>
<!--Вывести данные на страницуц из загруженной таблицы-->
<?php foreach ($reviews as $review): ?>
    <div>
        <b><?=$review['name']?></b>: <?=$review['review']?>

        <!--    кнопка для изменения сообщения с определенным id на той же самой странице,
        парамeтр action сами задаем и он подгружается $_POST, также туда передаем id-->
        <a href="?action=edit&id=<?=$review['id']?>">[edit]</a>

        <!--    кнопка для удаления сообщения с определенным id на той же самой странице-->
        <a href="?action=delete&id=<?=$review['id']?>">[x]</a>
        <!--    здесь передаем действие и сразу id-->
    </div>
<?php endforeach;?>



</body>
</html>