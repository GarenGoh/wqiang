<?php
namespace app\components;

use app\models\File;
use Yii;
use yii\base\Component;
use yii\web\UploadedFile;

class FileService extends Component
{
    public function saveToDb(UploadedFile $uploadedFile, $options)
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
        return json_encode(['url' => $file->url,'id' => $file->id]);
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

    public function search($where = [])
    {
        $query = File::find();
        if(isset($where['id']) && $where['id']) {
            $query->andFilterWhere(['id' => $where['id']]);
        }
        return $query;
    }


    public function saveToStorage(UploadedFile $uploadedFile, $options = [], $saveToDb = true)
    {
        $options = $this->parseOptions($uploadedFile, $options);

        if (empty($options['storage_ids'])) {
            $options['storage_ids'] = array_keys($this->storages);
        }

        $count = 0;
        foreach ($options['storage_ids'] as $key => $id) {
            $storage = $this->getStorage($id);
            if ($storage->getIsEnable() && $this->getStorage($id)->save($uploadedFile, $options)) {
                $count++;
            } else {
                unset($options['storage_ids'][$key]);
            }
        }

        if ($count == 0) {
            return false;
        }

        $file = $this->createFileModel($uploadedFile, $options);

        if ($saveToDb) {
            $file->save();
        }

        if ($file->hasErrors()) {
            $file->delete();
            return false;
        } else {
            return $file;
        }
    }


}
?>
