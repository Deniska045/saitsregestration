<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>

<body>
    <header>
        <div class="header">
            <ul class="menu">
                <a href="">Главная</a>
                <a href="">О нас</a>
                <a href="">Телефон</a>
            </ul>
        </div>
        <div class="font">
            <form action="registration.php">
                <div>
                    <input type="submit" value="регистрация">
                </div>
            </form>
            <form action="sign-in-form.php">
                <div>
                    <input type="submit" value="Войти">
                </div>
            </form>
        </div>
    </header>



    <?php

    use LDAP\Result;

    require("connect.php");


    $hashSession = $_COOKIE["session"];
    if (!$hashSession) {
    } else {



        $result = $connect->query("SELECT `role`, `name` FROM `account` AS a
                        INNER JOIN `session` AS s 
                        ON a.`id`=s.`account`
                        WHERE s.`hash`='$hashSession'");
        if (!$result) {
            $result = $connect->query("UPDATE `session` SET 'end' = current_timestap WHERE 'hash' = '$hashSession'");
            if (!$result) {
                echo $connect->error;
            }
            setcookie("session", "", 0);
            header("Location: /index.php", TRUE, 301);
        }

        $user = $result->fetch_assoc();
        $isLogin = true;
    ?>
        <h3>Здравствуйте, <?php
                            echo $user["name"] . " [";
                            echo $user["role"] . "]" . '<br>';

                            $user = $_SESSION['user_id'];


                            $user = $connect->query('SELECT * FROM `my_db`');

                            if (!$user) {
                                echo $connect->error;
                                return;
                            }


                            if ($user->num_rows > 0) {
                                while ($info_user = $user->fetch_assoc()) {

                                    echo '<div class="fega">'; ?>
                    <div class="ref"> <?php
                                        echo '<h3>Пользователь</h3>';
                                        ?></div>
                    <div class="ref"> <?php
                                        echo $info_user['surname'];
                                        ?></div>
                    <div class="ref"> <?php
                                        echo $info_user['name'];
                                        ?></div>
                    <div class="ref"> <?php
                                        echo $info_user['patronymic'];
                                        ?><img src="<?php echo $info_user['image']; ?>" /></div>
            <?php
                                }
                            }
            ?>

            <form enctype="multipart/form-data" class="info" action="info.php" method="POST">
                <input type="text" placeholder="Имя" name="name" size="30"><br />
                <label for="last_name"></label><br />
                <input type="text" placeholder="Информация" name="info" size="30"><br />
                <label for="text"></label><br />
                <input type="text" placeholder="Страна" name="country" size="30"><br />
                <label for="facebook"></label><br />
                <input name="price" placeholder="Цена" type="number" value="" size="30">
                <label for="facebook"></label><br />
                <input class="foto" name="image" type="file" />
                <label for="facebook"></label><br />
                <input class="cnopa" type="submit" value="Добавить">

            </form>

        </h3>
        <form action="logout.php" method="POST">
            <input type="submit" value="Выйти">
        </form>


    <?php
    }

    $result = $connect->query("SELECT `name`, `info`,`country`,`price`, `image` FROM `info`");
    if (!$result) {
        echo $connect->error;
        return;
    }
    if ($result->num_rows > 0) {
    ?>
        <table>
            <tr>
                <td>Имя</td>
                <td>Информация</td>
                <td>Страна</td>
                <td>Цена</td>
                <td>Фото</td>
            </tr>
            <?php
            while ($data = $result->fetch_assoc()) {
            ?><tr>


                    <td><?php echo $data['name']; ?> </td>
                    <td><?php echo $data['info']; ?> </td>
                    <td><?php echo $data['country']; ?> </td>
                    <td><?php echo $data['price']; ?> </td>
                    <td><img class="ft" src="img/<?php echo $data['image']; ?>" /></td>
                <?php
            }
            if ($isLogin == true) {
                ?><button></button><?php
                                    }
                                        ?>
                </tr><?php
                    }
                        ?>



</body>

</html>