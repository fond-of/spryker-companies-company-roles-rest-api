<?php

namespace FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\Reader;

use Generated\Shared\Transfer\RestCompanyRoleRequestTransfer;
use Generated\Shared\Transfer\RestCompanyRoleResponseTransfer;

interface CompanyRoleReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompanyRoleRequestTransfer $restCompanyRoleRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyRoleResponseTransfer
     */
    public function getByRestCompanyRoleRequest(
        RestCompanyRoleRequestTransfer $restCompanyRoleRequestTransfer
    ): RestCompanyRoleResponseTransfer;
}
