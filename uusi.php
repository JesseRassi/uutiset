<?php
session_start();
if (!isset( $_SESSION['user_id']) ) {
    header("Location: yllapito.php");
}
?><html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lisää artikkeli</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/tyyli.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row min-vh-100">
            <div class="col mx-auto"></div>
            <div class="col-lg-3 align-self-center" style="min-width: 600px">
                <label class="h4" for="lisartikkeli">Lisää artikkeli</label>
                <div class="form-group" id="lisartikkeli">
                    <form action="php/lisaa.php?e=0" method="POST" enctype="multipart/form-data">
                        <input type="number" name="id" readonly style="display: none">

                        <label for="otsikko">Otsikko</label>
                        <input class="form-control mb-2" id="otsikko" type="text" name="otsikko">

                        <label for="kirjoittaja">Kirjoittaja</label>
                        <input class="form-control mb-2" id="kirjoittaja" type="text" name="kirjoittaja">

                        <label for="artikkeli">Artikkeli</label>
                        <textarea class="form-control mb-2" id="artikkeli" type="text" name="artikkeli" rows="7"></textarea>

                        <label for="aiheet">Valitse aiheet</label>
                        <div class="form-group ml-5 mb-2" id="aiheet">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="kotimaa" name="kotimaa">
                                <label class="form-check-label" for="kotimaa">Kotimaa</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="ulkomaat" name="ulkomaat">
                                <label class="form-check-label" for="ulkomaat">Ulkomaat</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="politiikka"
                                    name="politiikka">
                                <label class="form-check-label" for="politiikka">Politiikka</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="talous" name="talous">
                                <label class="form-check-label" for="talous">Talous</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="urheilu" name="urheilu">
                                <label class="form-check-label" for="urheilu">Urheilu</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="viihde" name="viihde">
                                <label class="form-check-label" for="viihde">Viihde</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="terveys" name="terveys">
                                <label class="form-check-label" for="terveys">Terveys</label>
                            </div>
                        </div>

                        <label for="avainsanat">Avainsanat (5)</label>
                        <input class="form-control mb-2" id="avainsanat" type="text" name="avainsanat">

                        <label for="kuvateksti">Kuvateksti</label>
                        <input class="form-control mb-2" id="kuvateksti" type="text" name="kuvateksti">

                        <div class="custom-file mt-3" id="liskuva">
                            <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload">
                            <label class="custom-file-label" for="fileToUpload">Valitse kuva (.jpg)</label>
                        </div>

                        <input type="text" name="kuvapolku" readonly style="display: none">
                        <button type="submit" class="btn btn-primary mt-4">Lähetä</button>
                        <button onclick="window.history.go(-1); return false;" class="btn btn-primary mt-4">Peruuta</button>
                    </form>
                </div>

            </div>
            <div class="col mx-auto"></div>
        </div>
    </div>

    <script src="js/jquery-3.4.1.slim.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>