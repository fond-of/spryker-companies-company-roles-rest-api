<?php

namespace FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\Reader;

use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompanyRoleRequestTransfer;

interface CompanyReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCompanyRoleRequestTransfer $companyRoleRequestTransfer
     * @return \Generated\Shared\Transfer\CompanyTransfer|null
     */
    public function getByRestCompanyRoleRequest(
        RestCompanyRoleRequestTransfer $companyRoleRequestTransfer
    ): ?CompanyTransfer;
}
