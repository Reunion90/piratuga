<html>
    <head>
        <meta charset="UTF-8">
        <title>PIRATU.GA | Filmes, Séries e Anime</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,700,800" rel="stylesheet"> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">        <link rel="stylesheet" type="text/css" href="css/styles.css?<?php echo time(); ?>">
        <link rel="stylesheet" type="text/css" href="css/styles.css?<?php echo time(); ?>">
        <link rel="icon" href="icon.ico" sizes="16x16"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="js/main.js?<?php echo time(); ?>"></script>
        <script>
            window.onload = function() {
                var recaptcha = document.forms["reqform"]["g-recaptcha-response"];
                recaptcha.required = true;
                recaptcha.oninvalid = function(e) {
                    alert("Por favor complete o captcha");
                }
            }
        </script>
    </head>
    <body>
    <?php require_once("import/header.php");?>
        <section id="newsletter">
            <div class="newsletter-inner">
                <?php if(isset($_SESSION['username'])){
                    ?>
                    <h2>Faz o teu pedido! Vamos atendê-lo logo que possível.</h2>
                    <form id="reqform" class="sign_up_form" action="request.php" method="post">
                        <input type="hidden" id="username" name="username" value="<?php echo $_SESSION['username']?>">
                        <textarea required placeholder="Pedido" id="pedido" name="request"></textarea>
                        <div class="g-recaptcha" data-sitekey="6Ldys1QUAAAAAH7Xsu-we8VM9jCVTzxC70SRhvTM"></div>
                        <button class="button" onclick="requestSubmit();">Enviar</button>
                    </form>
                    <?php
                } else {
                    ?>
                    <h2>Precisas de uma conta de utilizador para fazer um pedido... Não custa nada!</h2>
                    <?php
                }?>
                
            </div>
        </section>

        <?php require_once("import/footer.php");?>
    </body>
</html>