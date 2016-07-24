<?php

namespace CrazyStudio\ActsAsTenant\filters;


use Yii;
use yii\base\ActionFilter;

class TenantFilter extends ActionFilter
{
    public $tenantModel;

    public function beforeAction($action)
    {
        Yii::$app->actsAsTenant->setTenantId();

        return true;
    }
}