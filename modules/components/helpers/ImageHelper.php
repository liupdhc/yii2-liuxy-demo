<?php

/**
 * FileName: ImageHelper.php
 * Author: liupeng
 * Date: 10/7/15
 */

namespace modules\components\helpers;
use yii\helpers\FileHelper;

/**
 * 附件工具类
 * Class ImageHelper
 * @package modules\components\helpers
 */
class ImageHelper extends FileHelper {

    /**
     * 获取文件后缀
     * @param $filePath
     */
    static function getExt($filePath) {
        return addslashes(strtolower(substr(strrchr($filePath, '.'), 1, 10)));
    }

    /**
     * 获取图片属性
     * @param $path 图片存储的绝对路径
     * @return array
     */
    static function getAttr($path) {
        list($width, $height, $type, $attr) = getimagesize($path);
        return array('width' => $width, 'height' => $height, 'type' => $type, 'attr' => $attr);
    }

    /**
     * 复制文件
     * @param $src  源文件
     * @param $dest
     * @return bool
     */
    static function copy($src, $dest) {
        copy($src, $dest);
        chmod($dest, 655);
        return file_exists($dest);
    }

    /**
     * 使用convert命令压缩图片
     * @param $src  源文件
     * @param $dest 目标文件
     * @param $ext  文件后缀
     * @param bool|false $size  压缩大小，格式：800x800!
     * @return bool
     */
    static function convert($src, $dest, $ext, $size = false) {
        if (!$size) {
            if ($ext == 'gif') {
                $exec_str = 'convert -coalesce  "'.$src.'" "'.$dest.'"';
                exec($exec_str);
                $exec_str = 'convert "'.$dest.'" "'.$dest.'"';
                exec($exec_str);
                chmod($dest, 655);
            } else {
                $exec_str = 'convert -quality 100 "'.$src.'" "'.$dest.'"';
                exec($exec_str);
                chmod($dest, 655);
            }

        } else {
            if ($ext == 'gif') {
                $exec_str = 'convert -coalesce  "'.$src.'" "'.$dest.'"';
                exec($exec_str);
                $exec_str = 'convert -resize "'.$size.'"  "'.$dest.'" "'.$dest.'"';
                exec($exec_str);
                chmod($dest, 655);
            } else {
                $exec_str = 'convert -quality 100 -resize "'.$size.'"  "'.$src.'" "'.$dest.'"';
                exec($exec_str);
                chmod($dest, 655);
            }
        }
        return file_exists($dest);
    }

    /**
     * 使用convert命令裁剪图片
     * @param $src  源文件
     * @param $dest 目标文件
     * @param $bound    裁剪定义，格式：300x400-10+10
     */
    static function crop($src, $dest, $bound) {
        $exec_str = 'convert  "'.$src.'"  -quality 100 +repage -crop "'.$bound.'" "'.$dest.'"';
        exec($exec_str);
        chmod($dest, 655);
    }

    /**
     * 本地存储文件，返回用于持久化记录的相对路径
     * @param $imageFile 源文件数组对象
     * @param $targetDirectory 文件最终存储的主目录
     * @param string $relativePath  持久化记录的相对路径的主目录
     * @return array    [存储的绝对路径,持久化记录的相对路径]
     * @throws \yii\base\Exception
     */
    static function localStorage($imageFile, $targetDirectory, $relativePath = '') {
        self::createDirectory($targetDirectory);

        $relativePath = self::normalizePath($relativePath.self::getSplitDirectory().'.'.self::getExt($imageFile['name']));

        $dest = self::normalizePath($targetDirectory.DIRECTORY_SEPARATOR.$relativePath);
        self::createDirectory(dirname($dest));

        self::copy($imageFile['tmp_name'], $dest);

        return [$dest, $relativePath];
    }

    /**
     * 获取分割细化的存储目录
     * @return string
     */
    private static function getSplitDirectory() {
        return date('Y').DIRECTORY_SEPARATOR.date('m').DIRECTORY_SEPARATOR.date('d').DIRECTORY_SEPARATOR.time () . rand ( 1000, 9999 );
    }
}