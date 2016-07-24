<?php

namespace CrazyStudio\ActsAsTenant;


use CrazyStudio\ActsAsTenant\exceptions\TenantCanNotBeChangedException;
use Yii;

trait ActsAsTenantTrait
{
    private static $tenantIdColumnName;

    public static function find()
    {
        $tenantId = Yii::$app->actsAsTenant->getTenantId();
        return parent::find()->where([self::getTenantIdColumnName() => $tenantId]);
    }

    public function __set($name, $value)
    {
        $tenantIdColumnName = self::getTenantIdColumnName();
        if ($name == $tenantIdColumnName && $this->$tenantIdColumnName != null) {
            throw new TenantCanNotBeChangedException();
        }

        parent::__set($name, $value);
    }

    private static function getTenantIdColumnName()
    {
        if (self::$tenantIdColumnName == null) {
            self::$tenantIdColumnName = Yii::$app->actsAsTenant->getTenantIdColumnName();
        }

        return self::$tenantIdColumnName;
    }
}