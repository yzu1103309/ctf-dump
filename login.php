<?php
isset($_GET['source']) and die(show_source(__FILE__, true));
?>

<?php
$host = 'chiikawa_db';
$dbuser = 'MYSQL_USER';
$dbpassword = 'MYSQL_PASSWORD';
$dbname = 'ctf_users';
$link = mysqli_connect($host, $dbuser, $dbpassword, $dbname);

$loginStatus = NULL;
$username = $_POST['username'];
$password = $_POST['password'];

if (isset($username) && isset($password)) {
    error_log('POST: [' . $username . '] [' . $password . ']');
    if ($link) {
        $blacklist = array("union", "select", "where", "and", "or");
        $replace = array("", "", "", "", "");
        $username = str_ireplace($blacklist, $replace, $username);
        $password = str_ireplace($blacklist, $replace, $password);
        $sql = "SELECT * FROM users WHERE `username` = '$username' AND `password` = '$password';";
        $query = mysqli_query($link, $sql);
        @$fetchs = mysqli_fetch_all($query, MYSQLI_ASSOC);
        if (@count($fetchs) > 0) {
            foreach ($fetchs as $fetch) {
                if ($fetch["username"] === 'Usagi' && $fetch["password"] === $password) {
                    $loginStatus = True;
                    break;
                }
                $loginStatus = False;
            }
        } else {
            $loginStatus = False;
        }
    } else {
        $loginStatus = NULL;
    }
} else {
    $loginStatus = NULL;
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- You can get source code at /?source -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="css/style.css" rel="stylesheet" >
    <link href="css/rainbow.css" rel="stylesheet">

</head>
<body>
<?php
    if ($loginStatus === True) {
    ?>
    <div class="flag-container">
        <div class="text-center d-flex justify-content-start flex-column" style="height: 6vh">
            <br>
            <p class="rainbow" style="font-size: 3em;">
                <?php echo $_ENV["FLAG"], '<br>'; ?>
            </p>
        </div>
        <img src="img/usagi.jpg" alt="usagi" style="display:block; margin:auto; margin-top:200px; max-width:500px; max-height:500px;">
    </div>
    <?php
    } else {
    ?>
    <body>
        <div class="login-container">
            <img src="img/chiikawa.jpeg" alt="User Image">
            <form method="POST" action="/">
                <input type="text" name="username" placeholder="username" required>
                <input type="password" name="password" placeholder="password" required>
                <button type="submit">submit</button>
            </form>
            <?php if ($loginStatus === False) { ?>
            <div class="alert">error password,please try again.</div>
            <?php } ?>
        </div>
    <body>
    <?php
    }
    ?>
</body>
</html>
