<?php

namespace FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business;

use Generated\Shared\Transfer\RestCompanyRoleRequestTransfer;
use Generated\Shared\Transfer\RestCompanyRoleResponseTransfer;

interface CompaniesCompanyRolesRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompanyRoleRequestTransfer $restCompanyRoleRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyRoleResponseTransfer
     */
    public function getCompanyRolesByRestCompanyRoleRequest(
        RestCompanyRoleRequestTransfer $restCompanyRoleRequestTransfer
    ): RestCompanyRoleResponseTransfer;
}
