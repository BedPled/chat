<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<form action="" method="GET">
    <div class="auf">
        <input required class="field" name="login" placeholder="Логин" value="admin">
        <br/>

        <input required class="field" name="password" placeholder="Пароль" value="admin">
        <br/>
        <button class="but">Авторизироваться</button>
    </div>
</form>

</body>

<?php
$MASSAGEtext = __DIR__ . '/mes.json';
$currentuser = "user";
$user = [
    "123" => "123",
    "roma" => "los",
    "admin" => "admin"
];

if (isset($_GET['login']) && isset($_GET['password']))
{

    if ((key_exists($_GET['login'], $user) == false)) {
        echo '<div class="authorisation">Неверный Логин</div>', "<br/>";
    } else {
        if ($user[$_GET['login']] != $_GET['password']) {
            echo '<div class="authorisation">Неверный пароль</div>', "<br/>";
        } else {

            echo '<div class="authorisationtrue">Авторизация успешно выполнена.</div>', "<br/>";
            $currentuser = $_GET['login'];
            echo '<div class="authorisationtrue">Добро пожаловать в чат, </div>';
            echo '<p style="text-align: center">' . $currentuser . '</p>';

        }
    }
}

echo "<br/>";

$messages = json_decode(file_get_contents($MASSAGEtext), true);

date_default_timezone_set('Asia/Vladivostok');

if (isset($_POST['message']) && $currentuser != "user") {
    $messages [] = [
        "currentuser" => $currentuser,
        "data" => date("d.m H:i"),
        "message" => $_POST['message']
    ];
}
file_put_contents(__DIR__ . '/mes.json', json_encode($messages));

foreach ($messages as $mes) { ?>
    <div class="text">
        <?=$mes["currentuser"]?>
        <?=$mes["data"]?>
        <?=$mes["message"]?>
    </div>
<?php }

echo "<br/>";
?>

<div class="in">
    <form action="" method="POST">
        <input class="field" name="message">
        <button class="but" name="but1">Отправить сообщение</button>
    </form>
</div>