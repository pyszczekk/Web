<?php require 'header.php' ?>
<h1 id="title">Załóż bloga!</h1>

    <form action="./nowy.php" method="post">
        <label>Nazwa bloga: <input type="text" name="blog_name"></label><br/>
       <label> Użytkownik: <input type="text" name="username"></label><br/>
        <label>Hasło: <input type="password" name="password"></label><br/>
       	<label> Opis: <textarea name="description"> </textarea></label><br/>
        <input type="submit">
        <input type="reset">
    </form>

<?php require 'footer.php' ?>
