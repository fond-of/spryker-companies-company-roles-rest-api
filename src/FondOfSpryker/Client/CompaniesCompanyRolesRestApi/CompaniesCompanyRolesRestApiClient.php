<?php

namespace FondOfSpryker\Client\CompaniesCompanyRolesRestApi;

use Generated\Shared\Transfer\RestCompanyRoleRequestTransfer;
use Generated\Shared\Transfer\RestCompanyRoleResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfSpryker\Client\CompaniesCompanyRolesRestApi\CompaniesCompanyRolesRestApiFactory getFactory()
 */
class CompaniesCompanyRolesRestApiClient extends AbstractClient implements CompaniesCompanyRolesRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompanyRoleRequestTransfer $restCompanyRoleRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyRoleResponseTransfer
     */
    public function getCompanyRolesByRestCompanyRoleRequest(
        RestCompanyRoleRequestTransfer $restCompanyRoleRequestTransfer
    ): RestCompanyRoleResponseTransfer {
        return $this->getFactory()->createCompaniesCompanyRolesRestApiStub()->getCompanyRolesByRestCompanyRoleRequest(
            $restCompanyRoleRequestTransfer
        );
    }
}
