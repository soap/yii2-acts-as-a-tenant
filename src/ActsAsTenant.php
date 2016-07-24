<?php

namespace CrazyStudio\ActsAsTenant;


use yii\base\Component;

class ActsAsTenant extends Component
{
    public $tenantModelClass;
    public $domainModelClass;
    public $tenantIdColumnName = 'tenant_id';

    private $tenantId;

    public function getTenantId()
    {
        if ($this->tenantId == null) {
            $this->tenantId = (new $this->tenantModelClass)->getTenantId();
        }

        return $this->tenantId;
    }

    public function setTenantId()
    {
        (new $this->tenantModelClass)->setTenantId();
    }

    public function getTenantIdColumnName()
    {
        return $this->tenantIdColumnName;
    }
}