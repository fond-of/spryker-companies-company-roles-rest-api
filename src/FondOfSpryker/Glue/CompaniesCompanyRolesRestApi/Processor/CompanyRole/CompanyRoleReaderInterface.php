<?php

declare(strict_types=1);

namespace FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\CompanyRole;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface CompanyRoleReaderInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function findCompanyRolesByCompanyId(
        RestRequestInterface $restRequest
    ): RestResponseInterface;
}
