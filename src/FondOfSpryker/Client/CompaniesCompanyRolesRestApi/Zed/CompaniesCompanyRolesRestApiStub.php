<?php

namespace FondOfSpryker\Client\CompaniesCompanyRolesRestApi\Zed;

use FondOfSpryker\Client\CompaniesCompanyRolesRestApi\Dependency\Client\CompaniesCompanyRolesRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestCompanyRoleRequestTransfer;
use Generated\Shared\Transfer\RestCompanyRoleResponseTransfer;

class CompaniesCompanyRolesRestApiStub implements CompaniesCompanyRolesRestApiStubInterface
{
    /**
     * @var \FondOfSpryker\Client\CompaniesCompanyRolesRestApi\Dependency\Client\CompaniesCompanyRolesRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfSpryker\Client\CompaniesCompanyRolesRestApi\Dependency\Client\CompaniesCompanyRolesRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(CompaniesCompanyRolesRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyRoleRequestTransfer $restCompanyRoleRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyRoleResponseTransfer
     */
    public function getCompanyRolesByRestCompanyRoleRequest(
        RestCompanyRoleRequestTransfer $restCompanyRoleRequestTransfer
    ): RestCompanyRoleResponseTransfer {
        /** @var \Generated\Shared\Transfer\RestCompanyRoleResponseTransfer $restCompanyRoleResponseTransfer */
        $restCompanyRoleResponseTransfer = $this->zedRequestClient->call(
            '/companies-company-roles-rest-api/gateway/get-company-roles-by-rest-company-role-request',
            $restCompanyRoleRequestTransfer
        );

        return $restCompanyRoleResponseTransfer;
    }
}
