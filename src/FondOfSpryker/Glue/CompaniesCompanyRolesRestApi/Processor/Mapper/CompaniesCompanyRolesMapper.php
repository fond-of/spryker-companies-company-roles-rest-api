<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\Mapper;

use FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\CompaniesCompanyRolesRestApiConfig;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\RestCompanyRoleAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;

class CompaniesCompanyRolesMapper implements CompaniesCompanyRolesMapperInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyRoleTransfer $companyRoleTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    public function mapCompanyRolesResource(
        CompanyRoleTransfer $companyRoleTransfer
    ): RestResourceInterface {
        $restCompanyRoleAttributesTransfer = new RestCompanyRoleAttributesTransfer();

        $restCompanyRoleAttributesTransfer->fromArray(
            $companyRoleTransfer->toArray(),
            true
        );

        $companyRolesResource = $this->restResourceBuilder->createRestResource(
            CompaniesCompanyRolesRestApiConfig::RESOURCE_COMPANY_ROLES,
            $companyRoleTransfer->getUuid(),
            $restCompanyRoleAttributesTransfer
        );

        $companyRolesResource->setPayload($companyRoleTransfer);

        return $companyRolesResource;
    }
}
