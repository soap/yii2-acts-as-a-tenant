<?php

namespace CrazyStudio\ActsAsTenant;


use CrazyStudio\ActsAsTenant\exceptions\TenantNotFoundException;
use Yii;

trait TenantTrait
{
    private static $tenantId;

    static function setTenantId()
    {
        $domain = Yii::$app->request->serverName;

        $tenantId = self::getTenantIdForDomain($domain);
        if (!isset($tenantId)) {
            $tenantId = self::getTenantIdForSubdomain($domain);
        }

        if (!isset($tenantId)) {
            throw new TenantNotFoundException($domain);
        }

        self::$tenantId = $tenantId;
    }

    static function getTenantId()
    {
        return self::$tenantId;
    }

    private static function getTenantIdForDomain($domain)
    {
        $domain = (new Yii::$app->actsAsTenant->domainModelClass)->findOne(['domain' => $domain]);
        if (isset($domain)) {
            return $domain->tenant_id;
        }
        return null;
    }

    private static function getTenantIdForSubdomain($domain)
    {
        $subdomain = self::getSubdomain($domain);
        $tenant = self::findOne(['subdomain' => $subdomain]);
        if (isset($tenant)) {
            return $tenant->id;
        }
        return null;
    }

    private static function getSubdomain($domain)
    {
        $parts = explode('.', $domain);
        return array_shift($parts);
    }
}