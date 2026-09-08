<?php

function encryptFile($sourceFile, $destinationFile)
{
    // 32-byte encryption key
    $key = "SecureExamProject2026AES256Key!!";

    // 16-byte Initialization Vector
    $iv = "1234567890123456";

    // Read PDF content
    $data = file_get_contents($sourceFile);

    // Encrypt using AES-256-CBC
    $encrypted = openssl_encrypt(
        $data,
        "AES-256-CBC",
        $key,
        OPENSSL_RAW_DATA,
        $iv
    );

    // Save encrypted file
    file_put_contents($destinationFile, $encrypted);
}
?>