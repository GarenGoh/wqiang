<?php
namespace app\helpers;

class Html extends \yii\helpers\Html
{
    public static function string($string, $length, $suffix = '...')
    {
        $string = strip_tags($string);
        $total = mb_strlen($string, 'utf-8');
        if ($length >= $total) {
            return $string;
        } else {
            return mb_substr($string, 0, $length, 'utf-8').$suffix;
        }
    }
}
?>
