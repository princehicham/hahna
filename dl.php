<?php 

    function decode($pData)
    {
        $encryption_key = 'themeluxurydotcom';

        $decryption_iv = '9999999999999999';

        $ciphering = "AES-256-CTR"; 
        
        $pData = str_replace(' ','+', $pData);

        $decryption = openssl_decrypt($pData, $ciphering, $encryption_key, 0, $decryption_iv);

        return $decryption;
    }

    if ( !empty($_GET['token']) ) {

        $token = decode($_GET['token']);

        $deJson = json_decode($token);

        // Force the download
        header('content-disposition: attachment; filename="'.$deJson->filename.'.'.$deJson->type.'"');
        header('content-length: ' . $deJson->size);
        header('content-transfer-encoding: binary');
        readfile($deJson->url);
        exit;

    } else echo 'Silence is Golden!';



