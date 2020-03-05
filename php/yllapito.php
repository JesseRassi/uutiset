
<?php
session_start();
?>
<html lang="en" style="overflow-y: scroll;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirjaudu sisään</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>

<div class="container-fluid">

<div class="row">

    <div class="col mx-auto"></div>

    <div class="col-lg-6">
        <div class="container-fluid row min-vh-100">
            <div class="col mx-auto"></div>
            <div class="col-lg-3 align-self-center" style="min-width: 300px"> 
                <div class="form-group" id="kirjaudu">
                    <label class="h4 mb-3" for="kirjaudu">Kirjaudu sisään</label>
                    <form action="login.php" method="post">
                    <input class="form-control" id="username" type="text" name="username" placeholder="Käyttäjänimi" required>

                    <input class="form-control mt-2" id="password" type="password" name="password" placeholder="Salasana" required>

                    <input type="submit" class="btn btn-primary mt-3" value="Kirjaudu">
                    <button onclick="window.history.go(-1); return false;" class="btn btn-primary mt-3">Peruuta</button>
                </form>
                </div>
            </div>
            <div class="col mx-auto"></div>
        </div>
    </div>

    <div class="col mx-auto"></div>

</div>

</div>

<script src="../js/jquery-3.4.1.slim.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>

</body>
</html>
