<?php

namespace FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade;

use FondOfSpryker\Zed\CompanyTypeRole\Business\CompanyTypeRoleFacadeInterface;
use Generated\Shared\Transfer\AssignableCompanyRoleCriteriaFilterTransfer;
use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;

class CompaniesCompanyRolesRestApiToCompanyTypeRoleFacadeBridge implements
    CompaniesCompanyRolesRestApiToCompanyTypeRoleFacadeInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompanyTypeRole\Business\CompanyTypeRoleFacadeInterface
     */
    protected $companyTypeRoleFacade;

    /**
     * @param \FondOfSpryker\Zed\CompanyTypeRole\Business\CompanyTypeRoleFacadeInterface $companyTypeRoleFacade
     */
    public function __construct(CompanyTypeRoleFacadeInterface $companyTypeRoleFacade)
    {
        $this->companyTypeRoleFacade = $companyTypeRoleFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\AssignableCompanyRoleCriteriaFilterTransfer $assignableCompanyRoleCriteriaFilterTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyRoleCollectionTransfer
     */
    public function getAssignableCompanyRoles(
        AssignableCompanyRoleCriteriaFilterTransfer $assignableCompanyRoleCriteriaFilterTransfer
    ): CompanyRoleCollectionTransfer {
        return $this->companyTypeRoleFacade->getAssignableCompanyRoles($assignableCompanyRoleCriteriaFilterTransfer);
    }
}
