<?php

namespace CrazyStudio\ActsAsTenant\exceptions;


class TenantCanNotBeChangedException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Tenant can not be changed");
    }
}