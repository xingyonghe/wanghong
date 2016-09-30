<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/14
 * Time: 9:59
 * Author: dch
 */
namespace App\Libraries\Picture;

use Intervention\Image\ImageManager;
use Intervention\Image\Constraint;
use Exception;
use Log;

class PictureManager
{
    public $background = '#ffffff';//背景颜色
    public $position = 'center'; //对齐模式
    public $driver = 'gd';//驱动

    /**
     * 生成图片 等比生成图片 , 会在同一目录中生成压缩图
     *
     * 新生成的图片文件名称格式: 文件名_$newWidth x $newHeight.后缀 的文件
     *
     * @param string $picPath 图片绝对路径
     * @param int $newWidth 新图宽
     * @param int $newHeight 新图高
     * @return false | $newPath
     */
    public function buildPicture($picPath, $newWidth, $newHeight)
    {
        try {
            if (!file_exists($picPath)) {
                return false;
            }
            $newPath = preg_replace('~(\.\w+)$~Uis', "_{$newWidth}x{$newHeight}$1", $picPath);
            // 通过指定 driver 来创建一个 image manager 实例
            $manager = new ImageManager(array('driver' => $this->driver));
            // 最后创建 image 实例
            $oldImage = $manager->make($picPath);

            if ($oldImage->getHeight() > $oldImage->getWidth()) {
                $resWidth = NULL;
                $resHeight = max($newWidth, $newHeight);
            } else {
                $resWidth = max($newWidth, $newHeight);
                $resHeight = NULL;
            }

            $oldImage->resize($resWidth, $resHeight, function (Constraint $constraint) {
                $constraint->aspectRatio();
            });
            $newImage = $manager->canvas($newWidth, $newWidth, $this->background);
            $newImage->insert($oldImage, $this->position);
            $newImage->save($newPath);

            $oldImage->destroy();
            $newImage->destroy();

            return $newPath;
        } catch (Exception $e) {
            Log::info($e);
        }

        return false;
    }

}