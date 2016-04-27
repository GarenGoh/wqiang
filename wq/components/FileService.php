<?php
namespace app\components;

use app\models\File;
use Yii;
use yii\base\Component;
use yii\web\UploadedFile;

class FileService extends Component
{
    public function save(UploadedFile $uploadedFile, $options)
    {
        $file = new File();
        $attributes = [
            'name' => $options['newName'],
            'old_name' => $uploadedFile->name,
            'size' => $uploadedFile->size,
            'type' => $uploadedFile->type,
            'prefix' => $options['prefix'],
        ];
        $file->setAttributes($attributes, false);
        $file->save();
        return  json_encode(['url' => $file->url,'id' => $file->id]);
    }

    /*public function save()
    {
        $file = new File();
        $attributes = [
            'name' => 'test.jpg',
            'old_name' => 'oldtest',
            'size' => '3333',
            'type' => 'jpg',
            'prefix' => 'ar/',
        ];
        $file->setAttributes($attributes, false);
        $file->save();
        print_r($file->url);
        exit;
    }*/
}
?>
