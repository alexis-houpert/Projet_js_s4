<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Titre de la page</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <script src="script/login.js"></script>
    <script src="script/main.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

</head>
<body>



<h2>Boisson à composer</h2>



<form action="userpage.php" method="post" id="form-login">
<fieldset id="message">
        <div class="form-group row">
            <input type="text" value="id">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input name="mdp" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
    <button type="submit">Envoyer</button>
    </fieldset>
</form>

<label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
<div class="col-sm-10">
    <input type="text" class="form-control-plaintext" id="staticEmail" value="email@example.com">
</div>

<p>Nullam quis risus eget <a href="#">urna mollis ornare</a> vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.</p>
<p><small>This line of text is meant to be treated as fine print.</small></p>
<p>The following is <strong>rendered as bold text</strong>.</p>
<p>The following is <em>rendered as italicized text</em>.</p>
<p>An abbreviation of the word attribute is <abbr title="attribute">attr</abbr>.</p>

</body>
</html>