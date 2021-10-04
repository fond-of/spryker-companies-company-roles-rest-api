<?php

namespace FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\Reader;

use FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyFacadeInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompanyRoleRequestTransfer;

class CompanyReader implements CompanyReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyFacadeInterface
     */
    protected $companyFacade;

    /**
     * @param \FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyFacadeInterface $companyFacade
     */
    public function __construct(CompaniesCompanyRolesRestApiToCompanyFacadeInterface $companyFacade)
    {
        $this->companyFacade = $companyFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyRoleRequestTransfer $companyRoleRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer|null
     */
    public function getByRestCompanyRoleRequest(
        RestCompanyRoleRequestTransfer $companyRoleRequestTransfer
    ): ?CompanyTransfer {
        $companyUuid = $companyRoleRequestTransfer->getCompanyUuid();

        if ($companyUuid === null) {
            return null;
        }

        $companyResponseTransfer = $this->companyFacade->findCompanyByUuid(
            (new CompanyTransfer())->setUuid($companyUuid)
        );

        if (!$companyResponseTransfer->getIsSuccessful()) {
            return null;
        }

        return $companyResponseTransfer->getCompanyTransfer();
    }
}
