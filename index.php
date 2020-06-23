<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Google 2FA Demo</title>
    </head>
    <body>
        <h3>Google 2FA Demo</h3>
        <?php
            require_once __DIR__ . '/vendor/autoload.php';
            use Sonata\GoogleAuthenticator\GoogleAuthenticator;
            use Sonata\GoogleAuthenticator\GoogleQrUrl;
            $secret = 'OMZWGLSSGM3Q====';
        ?>
        <img src="<?=GoogleQrUrl::generate('Jorgeley', $secret, 'Google 2FA Demo')?>" alt="qrcode">
        <p>Use the QR Code above to register your application in Google Authenticator</p><br>
        <form method="get" action="?"> 
            <input type="text" name="code" placeholder="your Google Authenticator generated code" style="width: 250px">
            <input type="submit" value="validate">
        </form>
        <p>
            <?php
                $code = filter_input(INPUT_GET, 'code');
                if ($code){
                    $google2FA = new GoogleAuthenticator();
                    echo 'current code is: ' . $google2FA->getCode($secret) . '<br>';
                    if ($google2FA->checkCode($secret, $code)){
                        echo 'valid';
                    }else{
                        echo 'invalid';
                    }
                }
            ?>
        </p>
    </body>
</html>