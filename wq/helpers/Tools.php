<?php
namespace app\helpers;

class Tools
{
    /*
     * 随机生成一个由大小写字母及书记组成的字符串；
     * $length 生成字符串的长度；
     */
    public static function getRandChar($length){
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol)-1;

        for($i=0;$i<$length;$i++){
            $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }

        return $str;
    }

    /*
     * *****生成缩略图*****
     * 只考虑jpg,png,gif格式
     * $srcImgPath 源图象路径
     * $targetImgPath 目标图象路径
     * $targetW 目标图象宽度
     * $targetH 目标图象高度
     */
    public static function makeThumbnail($srcImgPath,$targetImgPath,$targetW,$targetH)
    {
        $imgSize = GetImageSize($srcImgPath);
        $imgType = $imgSize[2];
        //@ 使函数不向页面输出错误信息
        switch ($imgType)
        {
            case 1:
                $srcImg = @ImageCreateFromGIF($srcImgPath);
                break;
            case 2:
                $srcImg = @ImageCreateFromJpeg($srcImgPath);
                break;
            case 3:
                $srcImg = @ImageCreateFromPNG($srcImgPath);
                break;
        }
        //取源图象的宽高
        $srcW = ImageSX($srcImg);
        $srcH = ImageSY($srcImg);
        if($srcW>$targetW || $srcH>$targetH)
        {
            $targetX = 0;
            $targetY = 0;
            if ($srcW > $srcH)
            {
                $finaW=$targetW;
                $finalH=round($srcH*$finaW/$srcW);
                $targetY=floor(($targetH-$finalH)/2);
            }
            else
            {
                $finalH=$targetH;
                $finaW=round($srcW*$finalH/$srcH);
                $targetX=floor(($targetW-$finaW)/2);
            }
            //function_exists 检查函数是否已定义
            //ImageCreateTrueColor 本函数需要GD2.0.1或更高版本
            if(function_exists("ImageCreateTrueColor"))
            {
                $targetImg=ImageCreateTrueColor($targetW,$targetH);
            }
            else
            {
                $targetImg=ImageCreate($targetW,$targetH);
            }
            $targetX=($targetX<0)?0:$targetX;
            $targetY=($targetX<0)?0:$targetY;
            $targetX=($targetX>($targetW/2))?floor($targetW/2):$targetX;
            $targetY=($targetY>($targetH/2))?floor($targetH/2):$targetY;
            //背景白色
            $white = ImageColorAllocate($targetImg, 255,255,255);
            ImageFilledRectangle($targetImg,0,0,$targetW,$targetH,$white);
            /*
                   PHP的GD扩展提供了两个函数来缩放图象：
                   ImageCopyResized 在所有GD版本中有效，其缩放图象的算法比较粗糙，可能会导致图象边缘的锯齿。
                   ImageCopyResampled 需要GD2.0.1或更高版本，其像素插值算法得到的图象边缘比较平滑，该函数的速度比ImageCopyResized慢。
            */
            if(function_exists("ImageCopyResampled"))
            {
                ImageCopyResampled($targetImg,$srcImg,$targetX,$targetY,0,0,$finaW,$finalH,$srcW,$srcH);
            }
            else
            {
                ImageCopyResized($targetImg,$srcImg,$targetX,$targetY,0,0,$finaW,$finalH,$srcW,$srcH);
            }
            switch ($imgType) {
                case 1:
                    ImageGIF($targetImg,$targetImgPath);
                    break;
                case 2:
                    ImageJpeg($targetImg,$targetImgPath);
                    break;
                case 3:
                    ImagePNG($targetImg,$targetImgPath);
                    break;
            }
            ImageDestroy($srcImg);
            ImageDestroy($targetImg);
        }
        else //不超出指定宽高则直接复制
        {
            copy($srcImgPath,$targetImgPath);
            ImageDestroy($srcImg);
        }
    }
}

?>
