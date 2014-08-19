<?php
namespace app\components;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use \Mett\UUID;

class UuidBehavior extends Behavior
{
    public $attributes;

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeInsert'
        ];
    }

    public function beforeInsert()
    {
        $model      = $this->owner;
        if (!$model->isNewRecord) {
//            error_log('go out, correction only when model is just created');
            return true;
        }

        $attributes = $this->attributes['beforeInsert'];

        foreach ($attributes as $attributeName) {
            if ($model->isNewRecord && empty($model[$attributeName])) {
                $model[$attributeName] = UUID::v4();
                // error_log("New Specimen\'s attribute $attributeName was empty. Fixed to: " . $model[$attributeName]);
            }
        }

        return true;
    }
}