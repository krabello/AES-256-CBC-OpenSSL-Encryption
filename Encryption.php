<?php

/**
 * Class Encryption
 *
 * PHP Wrapper class for AES-256-CBC OpenSSL string encryption.
 * 
 * Purpose of the class is to encrypt strings of potentially sensitive data
 * for storage and provide a simple way to decrypt.
 * 
 * Requires openssl_encrypt and openssl_decrypt libraries to be installed
 * for PHP. Allows encryption and decryption for AES 256 CBC.
 *
 * @author      krabello <kevin.rabello@gmail.com>
 * @license     http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version     1.0
 * @copyright   (c) 2017, Kevin Rabello
 */
class Encryption
{
    /**
     * @var string cipher
     */
    private static $method = 'aes-256-cbc';
    
    /**
     * encrypt
     *
     * returns a base 64 encoded encrypted string
     *
     * @param string $data
     * @param string $key
     *
     * @return string encrypted string
     */
    public static function encrypt($data, $key)
    {
        // Generate an initialization vector
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::$method));
        
        // Encrypt the data using AES 256 encryption in CBC mode using our
        // encryption key and initialization vector.
        $encrypted = openssl_encrypt($data, self::$method, base64_decode($key), 0, $iv);
        
        return base64_encode($encrypted . '::' . $iv);
    }
    
    /**
     * decrypt
     *
     * returns a decrypted string
     *
     * @param string $data
     * @param string $key
     *
     * @return string decrypted string
     */
    public static function decrypt($data, $key)
    {
        // To decrypt, split the encrypted data from our IV - our unique separator used was "::"
        list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
        
        return openssl_decrypt($encrypted_data, self::$method, base64_decode($key), 0, $iv);
    }
}
