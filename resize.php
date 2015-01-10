<?php

/**
 * 图片缩放函数（可设置高度固定，宽度固定或者最大宽高，支持gif/jpg/png三种类型）
 * Author : Specs
 * Homepage: http://9iphp.com/web/php/1208.html
 *
 * @param string $source_path 源图片
 * @param int $target_width 目标宽度
 * @param int $target_height 目标高度
 * @param string $fixed_orig 锁定宽高（可选参数 width、height或者空值）
 * @return string
 */
function myImageResize($source_path, $target_width = 200, $target_height = 200, $fixed_orig = ''){
    $source_info = getimagesize($source_path);
    $source_width = $source_info[0];
    $source_height = $source_info[1];
    $source_mime = $source_info['mime'];
    $ratio_orig = $source_width / $source_height;
    if ($fixed_orig == 'width'){
        //宽度固定
        $target_height = $target_width / $ratio_orig;
    }elseif ($fixed_orig == 'height'){
        //高度固定
        $target_width = $target_height * $ratio_orig;
    }else{
        //最大宽或最大高
        if ($target_width / $target_height > $ratio_orig){
            $target_width = $target_height * $ratio_orig;
        }else{
            $target_height = $target_width / $ratio_orig;
        }
    }
    switch ($source_mime){
        case 'image/gif':
            $source_image = imagecreatefromgif($source_path);
            break;
        
        case 'image/jpeg':
            $source_image = imagecreatefromjpeg($source_path);
            break;
        
        case 'image/png':
            $source_image = imagecreatefrompng($source_path);
            break;
        
        default:
            return false;
            break;
    }
    $target_image = imagecreatetruecolor($target_width, $target_height);
    imagecopyresampled($target_image, $source_image, 0, 0, 0, 0, $target_width, $target_height, $source_width, $source_height);
    header('Content-type: image/jpeg');
    $imgArr = explode('.', $source_path);
    $target_path = $imgArr[0] . '_new.' . $imgArr[1];
    imagejpeg($target_image, $target_path, 100);
}
myImageResize('image-resize.jpg', 200, 200,'width'); //最大宽高
