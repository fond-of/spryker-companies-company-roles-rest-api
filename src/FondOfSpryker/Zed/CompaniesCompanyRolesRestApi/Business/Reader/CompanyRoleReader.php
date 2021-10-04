<?php

namespace FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\Reader;

use FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyTypeRoleFacadeInterface;
use Generated\Shared\Transfer\AssignableCompanyRoleCriteriaFilterTransfer;
use Generated\Shared\Transfer\RestCompanyRoleRequestTransfer;
use Generated\Shared\Transfer\RestCompanyRoleResponseTransfer;

class CompanyRoleReader implements CompanyRoleReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\Reader\CompanyReaderInterface
     */
    protected $companyReader;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyTypeRoleFacadeInterface
     */
    protected $companyTypeRoleFacade;

    /**
     * @param \FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\Reader\CompanyReaderInterface $companyReader
     * @param \FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyTypeRoleFacadeInterface $companyTypeRoleFacade
     */
    public function __construct(
        CompanyReaderInterface $companyReader,
        CompaniesCompanyRolesRestApiToCompanyTypeRoleFacadeInterface $companyTypeRoleFacade
    ) {
        $this->companyReader = $companyReader;
        $this->companyTypeRoleFacade = $companyTypeRoleFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyRoleRequestTransfer $restCompanyRoleRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyRoleResponseTransfer
     */
    public function getByRestCompanyRoleRequest(
        RestCompanyRoleRequestTransfer $restCompanyRoleRequestTransfer
    ): RestCompanyRoleResponseTransfer {
        $restCompanyRoleResponseTransfer = (new RestCompanyRoleResponseTransfer())
            ->setIsSuccess(false);

        $companyTransfer = $this->companyReader->getByRestCompanyRoleRequest($restCompanyRoleRequestTransfer);

        if ($companyTransfer === null || $companyTransfer->getIdCompany() === null) {
            return $restCompanyRoleResponseTransfer;
        }

        $assignableCompanyRoleCriteriaFilterTransfer = (new AssignableCompanyRoleCriteriaFilterTransfer())
            ->setIdCustomer($restCompanyRoleRequestTransfer->getIdCustomer())
            ->setIdCompany($companyTransfer->getIdCompany());

        $companyRoleCollectionTransfer = $this->companyTypeRoleFacade->getAssignableCompanyRoles(
            $assignableCompanyRoleCriteriaFilterTransfer
        );

        return $restCompanyRoleResponseTransfer->setIsSuccess(true)
            ->setCompanyRoleCollection($companyRoleCollectionTransfer);
    }
}
