<?php require 'header.php' ?>
<h1 >Dodaj komentarz do <?php echo "<em>".$_GET['blog']."</em> do posta <em>".$_GET['post']."</em>";?></h1>

    <form action="./koment.php" method="post" enctype="multipart/form-data">
        <label>Typ: <select name="type">
            <option>Pozytywny</option>
            <option>Negatywny</option>
            <option>Neutralny</option>
        </select></label><br/>
        <label>Komentarz: <textarea name="kom" cols="30" rows="10"></textarea></label><br/>
        <label>Nick: <input type="text" name="name"/></label>
        <input type="hidden" name="post" value="<?php echo $_GET['post']; ?>">
        <input type="hidden" name="blog" value="<?php echo $_GET['blog']; ?>">
        <input type="submit" >
        <input type="reset" >
    </form>

<?php require 'footer.php' ?>

