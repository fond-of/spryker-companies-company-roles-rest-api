<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\CompaniesCompanyRolesRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class CompaniesCompanyRolesRestApiConfig extends AbstractBundleConfig
{
    public const RESOURCE_COMPANIES = 'companies';
    public const RESOURCE_COMPANY_ROLES = 'company-roles';

    public const RESOURCE_COMPANIES_COMPANY_ROLES = 'companies-company-roles';
    public const CONTROLLER_COMPANIES_COMPANY_ROLES = 'companies-company-roles-resource';

    public const RESPONSE_CODE_COMPANY_NOT_FOUND = '1300';
    public const RESPONSE_CODE_ACCESS_DENIED = '1302';

    public const RESPONSE_COMPANY_NOT_FOUND = 'Company not found.';
    public const RESPONSE_DETAILS_ACCESS_DENIED = 'Access Denied';
}
