<?php

namespace FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business;

use Generated\Shared\Transfer\RestCompanyRoleRequestTransfer;
use Generated\Shared\Transfer\RestCompanyRoleResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\CompaniesCompanyRolesRestApiBusinessFactory getFactory()
 */
class CompaniesCompanyRolesRestApiFacade extends AbstractFacade implements CompaniesCompanyRolesRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompanyRoleRequestTransfer $restCompanyRoleRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyRoleResponseTransfer
     */
    public function getCompanyRolesByRestCompanyRoleRequest(
        RestCompanyRoleRequestTransfer $restCompanyRoleRequestTransfer
    ): RestCompanyRoleResponseTransfer {
        return $this->getFactory()
            ->createCompanyRoleReader()
            ->getByRestCompanyRoleRequest($restCompanyRoleRequestTransfer);
    }
}
