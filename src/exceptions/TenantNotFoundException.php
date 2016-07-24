<?php

namespace CrazyStudio\ActsAsTenant\exceptions;


class TenantNotFoundException extends \Exception
{
    public function __construct($tenant)
    {
        parent::__construct("Tenant not found: ${tenant}");
    }
}