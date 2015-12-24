<?php
/**
 * FileName: EncryterHelper.php
 * Author: liupeng
 * Date: 12/15/15
 */

namespace modules\components\helpers;


class EncryterHelper {
    /**
     * 加密
     * @param unknown $text
     * @param unknown $key
     * @param string $algo
     * @param string $mode
     * @return string
     */
    public static function encrypt($text, $key, $algo = MCRYPT_RIJNDAEL_256, $mode = MCRYPT_MODE_CBC) {
        // Create IV for encryption
        $iv = mcrypt_create_iv(mcrypt_get_iv_size($algo, $mode), MCRYPT_RAND);

        // Encrypt text and append IV so it can be decrypted later
        $mcryptKey = $algo == MCRYPT_RIJNDAEL_256 ? hash('sha256', $key, TRUE) : md5($key);

        $text = mcrypt_encrypt($algo, $mcryptKey, $text, $mode, $iv) . $iv;

        // Prefix text with HMAC so that IV cannot be changed
        return bin2hex($text);
    }

    /**
     * 解密
     * @param unknown $text
     * @param unknown $key
     * @param string $algo
     * @param string $mode
     * @return void|string
     */
    public static function decrypt($text, $key, $algo = MCRYPT_RIJNDAEL_256, $mode = MCRYPT_MODE_CBC) {
        $text = pack('H*', $text);

        // Get IV off end of encrypted string
        $iv = substr($text, -mcrypt_get_iv_size($algo, $mode));

        // Decrypt string using IV and remove trailing \x0 padding added by mcrypt
        $mcryptKey = $algo == MCRYPT_RIJNDAEL_256 ? hash('sha256', $key, TRUE) : md5($key);

        return rtrim(mcrypt_decrypt($algo, $mcryptKey, substr($text, 0, -strlen($iv)), $mode, $iv), "\x0");
    }
}