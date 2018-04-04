<?php

    // https://www.shift8web.ca/2017/04/how-to-encrypt-and-execute-your-php-code-with-mcrypt/
    $key = '27364gFrsyeBse539jFgSSy320Odye37';
    define('IV_SIZE', mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));

    # AES-128-CBC mcrypt 
    
    function mcryptEncrypt($key, $payload) {
        $iv = mcrypt_create_iv(IV_SIZE, MCRYPT_DEV_URANDOM);
        $crypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $payload, MCRYPT_MODE_CBC, $iv);
        $combo = $iv . $crypt;
        $garble = base64_encode($iv . $crypt);
        return $garble;
    }
    
    function mcryptDecrypt($key, $garble) {
        $combo = base64_decode($garble);
        $iv = substr($combo, 0, IV_SIZE);
        $crypt = substr($combo, IV_SIZE, strlen($combo));
        $payload = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $crypt, MCRYPT_MODE_CBC, $iv);
        return $payload;
    }


?>