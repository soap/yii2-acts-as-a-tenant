<?php

namespace CrazyStudio\ActsAsTenant\behaviors;


use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;

class TenantBehavior extends AttributeBehavior
{
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [BaseActiveRecord::EVENT_BEFORE_INSERT => Yii::$app->actsAsTenant->getTenantIdColumnName()];
        }
    }

    protected function getValue($event)
    {
        return Yii::$app->actsAsTenant->getTenantId();
    }
}