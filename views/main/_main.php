<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 

        <?= $head ?>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">     
        <link rel="icon" type="image/png" href="<?= theme("/assets/images/favicon.png") ?>"/>

        <!-- Custom Style -->                
        <link rel="stylesheet" href="<?= theme("/assets/css/style.css") ?>"/>

    </head>


    <body id="myPage" data-spy="scroll" data-target=".sidenav">          

        <main class="main-content d-flex flex-column justify-content-center align-content-center align-items-center">   
            <?= $v->section("content") ?>
        </main>  


        <!--FOOTER-->
        <?php
        $v->insert("footer");
        ?>


        <!--AJAX LOAD-->
        <div class="ajax-load flex-column justify-content-center align-content-center align-items-center">
            <div class="spinner-border text-light" style="width: 3rem; height: 3rem;"></div>           
            <p class="text-light ajax-load-box-title" style="margin-top: 20px; font-size: 1.1rem; font-weight: 600;">Aguarde, carregando...</p>
        </div>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- JMASK -->
        <script src="<?= theme("/assets/js/jquery.mask.min.js") ?>"></script>  
        
        <!-- JQUERY FORM -->
        <script src="<?= theme("/assets/js/jquery.form.min.js") ?>"></script>  
        
        <!-- Custom JavaScript -->
        <script src="<?= theme("/assets/js/scripts.js") ?>"></script>


        <?= $v->section("scripts"); ?>

    </body>

</html>
