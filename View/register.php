<?php include_once "header.php"; ?>

<!-- Widok rejestracji użytkownika-->

<body>
<div id="site_content">
    <div id="content">
        <h2>DODAJ UŻYTKOWNIKA</h2>

    <form class="form_settings" action="../Controller/controller.php?method=insertUser" method=post>
        <input type="text" placeholder="imie" name="name" class="data" required autofocus />
        <input type="text" placeholder="nazwisko" name="surname" class="data" required autofocus />
        <input type="email" placeholder="email" name="email" class="data" required />
        <input type="password" placeholder="haslo" name="password" class="data" required />
        <input type="password" placeholder="powtorz haslo" name="password2" class="data" required />

        <input type="text" placeholder="miasto" name="city" class="data" required />
        <input type="text" placeholder="kod pocztowy" name="zip" class="data" required />
        <input type="text" placeholder="ulica" name="street" class="data" required />
        <input type="text" placeholder="nr domu" name="house" class="data" required />
        <input type="text" placeholder="nr mieszkania" name="flat" class="data" value="" />
        <input type="text" placeholder="telefon" name="phone" class="data" required />

        <input type="submit" class="submit" value="DODAJ" />
    </form>
    </div>
</div>
<?php include_once "footer.php"; ?>
</body>
</html>