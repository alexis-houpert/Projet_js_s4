
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Titre de la page</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>

    <script src="/script/login.js"></script>

</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" wfd-id="651">
            <span class="navbar-toggler-icon" wfd-id="466"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01" wfd-id="458">
            <ul class="navbar-nav mr-auto" wfd-id="460">
                <li class="nav-item active" wfd-id="464">
                    <a class="nav-link" href="index.php">Home <span class="sr-only" wfd-id="465">(current)</span></a>
                </li>
                <li class="nav-item" wfd-id="463">
                    <a class="nav-link" href="view/inscription.php">Inscription</a>
                </li>
            </ul>
        </div>
    </nav>
</header>


<h2>Boisson à composer</h2>

<div class="alert alert-dismissible alert-warning">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4 class="alert-heading">Warning!</h4>
    <p class="mb-0">Vous n'êtes pas connecté ! Pour accéder aux fonctionnalités du site veuillez vous connecter</p>
</div>




<legend style="width: 20%; margin-left: auto; margin-right: 5%;">Connexion</legend>


<form id="formconnect" name="formconnect" action="login.php" method="post" wfd-id="337" style="width: 20%; margin-left: auto; margin-right: 5%;">
    <fieldset>
<div class="form-group" wfd-id="361">
    <label for="exampleInputEmail1" wfd-id="362">Email address</label>
    <input name="mailconnect" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" wfd-id="510">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
</div>
<div class="form-group" wfd-id="359">
    <label for="exampleInputPassword1" wfd-id="360">Password</label>
    <input name="mdpconnect" type="password" class="form-control" id="password" placeholder="Password" wfd-id="509">
</div>
    </fieldset>
    <button id="submitconnect" name="submitconnect" type="submit" class="btn btn-primary" wfd-id="575">Submit</button>
</form>



<div style="display: none" id="message" class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <div id="text_message"><strong>Well done!</strong> Connection successful </div>
</div>
<?php
if (isset($erreur))
    echo '<label id="phpMessage" color="red">'.$erreur.'</label>';
?>



</body>
</html>
