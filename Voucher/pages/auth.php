<?php
if(!isset($_COOKIE["auth_cookie"])) {
    echo "<form method='post'>

    <label>
        Логин
    </label>
    <input type='text' name='username'><br>
    <label>
        Пароль
        
    </label><br>
    <input type='text' name='password'>
    <button type='submit' value='login' name='login'>Войти</button>

</form>";
}
else {
    echo "<form method='post'><button type='submit' value='Выйти' name='logout'>Выйти</button></form>";
}

if (isset($_POST["login"]))  {
    header("Refresh: 0");
        if ($_POST["username"] == "admin" and $_POST["password"] == "123") {
            $cookie_name = "auth_cookie";
            $cookie_value = 1;
            setcookie($cookie_name, "1", time() + (86400 * 30), "/");
        }
    }
if (isset($_POST["logout"])) {
    header("Refresh: 0");
    $cookie_name = "auth_cookie";
    $cookie_value = 1;
    setcookie($cookie_name, "1", time() - (86400 * 30), "/");
}
?>