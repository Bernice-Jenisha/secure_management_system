<?php

function decryptFile($encryptedFile, $outputFile)
{
    $key = "SecureExamProject2026AES256Key!!";
    $iv = "1234567890123456";

    $encryptedData = file_get_contents($encryptedFile);

    $decrypted = openssl_decrypt(
        $encryptedData,
        "AES-256-CBC",
        $key,
        OPENSSL_RAW_DATA,
        $iv
    );

    file_put_contents($outputFile, $decrypted);
}
?>