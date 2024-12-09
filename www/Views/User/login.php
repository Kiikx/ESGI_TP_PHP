<?php
if (!empty($errors)) {
    echo '<div style="background-color: red">';
    echo "<ul>";
    foreach ($errors as $error) {
        echo '<li>' . $error . '</li>';
    }
    echo "</ul>";
    echo '</div>';
}
?>

<form method="POST" action="/se-connecter">
    <input name="email" type="email" placeholder="Votre email" required><br>
    <input name="pwd" type="password" placeholder="Votre mot de passe" required><br>
    <input type="submit" value="Se connecter"><br>
</form>
