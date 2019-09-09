<?php

declare(strict_types=1);

namespace FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyRoleTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;

interface CompaniesCompanyRolesMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyRoleTransfer $companyRoleTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    public function mapCompanyRolesResource(
        CompanyRoleTransfer $companyRoleTransfer
    ): RestResourceInterface;
}
