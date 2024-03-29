<?php
require_once '../views/header.php';
?>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header text-center">
                    <h1 class="alert alert-danger">Requête invalide</h1>
                    <img src="../assets/img/404.png" class="img-fluid">   
                </div>
                <div class="alert alert-danger text-center">
                    <p>Désolé, votre demande est invalide. S'il vous plaît <a href="../index.php" class="alert-info">revenez en arrière</a> et réessayez.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once 'footer.php';
?>