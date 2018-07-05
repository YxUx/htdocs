
<?php include_once "header.php"; ?>

<!-- widok strony logowania -->

<body>
<div id="site_content">
    <div id="content">
        <h2>LOGOWANIE</h2>
        <form class="form_settings" action="../Controller/controller.php?method=login" method=post>
            <label>Email</label>
            <input type="text" placeholder="podaj email"name="email" autocomplete="on" required/> <br/>
            <label>Hasło</label>
            <input type="password" placeholder="podaj hasło" name="password" autocomplete="off" class="data" required /><br/>

            <input type="submit" class="submit" name="loginSubmit" value="Login">
        </form>
    </div>
</div>
<?php include_once "footer.php"; ?>
</body>
</html>