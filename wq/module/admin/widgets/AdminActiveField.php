<?php

namespace app\module\admin\widgets;
use Yii;
use yii\bootstrap\ActiveField;
use app\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

class AdminActiveField extends ActiveField
{
    /*
     * 由对象名和属性名生成一段字符串作为对象属性的ID标识；
     * 例如：article-title
     */
    public function getAttributeId()
    {
        return Html::getInputId($this->model, $this->attribute);
    }

    public function getAttributeValue()
    {
        return Html::getAttributeValue($this->model, $this->attribute);
    }

    public function getAttributeName()
    {
        return Html::getAttributeName($this->attribute);
    }



    public function image($options = [])
    {
        return $this->file($options, true);
    }

    public function file($options = [], $isImage = false)
    {
        $html = '';
        $fileId = 'file';
        $prefix = 'article';
        $html .= '<div id="'.$fileId.'" class="upload">';
        $html .= '
        <i class="select fa fa-'.($isImage?'picture-o':'file').'"></i>
        <i style="display:none;" class="uploading fa fa-spinner fa-spin"></i>
        ';
        $html .= '<input type="file" class="input" name="'.$fileId.'"></div>';
        $this->parts['{input}'] = $html;
        $js = "
            var {$fileId} = $('#{$fileId}');
            {$fileId}.find('.input').fileupload({
            url: '".Url::to(['/api/file/file', 'prefix' => $prefix])."',
            start: function() {
                {$fileId}.find('.file').hide();
                {$fileId}.find('.select').hide();
                {$fileId}.find('.uploading').show();
            },
            success: function (result, textStatus, jqXHR) {
                {$fileId}.find('.file').attr('src', result.url);
                {$fileId}.find('.file').show();
                Message.success('文件已上传，保存数据后生效！');
            },
            error: function (xhr, status) {
                {$fileId}.find('.select').show();
                if (typeof xhr.responseJSON === 'undefined') {
                    Message.error('文件上传失败');
                } else {
                    Message.error(xhr.responseJSON.message);
                }
            },
            complete: function() {
                {$fileId}.find('.uploading').hide();
            }
          });
          ";
        $this->form->view->registerJs($js, View::POS_END);
        return $this;
    }
}
