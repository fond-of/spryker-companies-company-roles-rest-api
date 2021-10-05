<?php

namespace FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business;

use FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\Reader\CompanyReader;
use FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\Reader\CompanyReaderInterface;
use FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\Reader\CompanyRoleReader;
use FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\Reader\CompanyRoleReaderInterface;
use FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\CompaniesCompanyRolesRestApiDependencyProvider;
use FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyFacadeInterface;
use FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyTypeRoleFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class CompaniesCompanyRolesRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\Reader\CompanyRoleReaderInterface
     */
    public function createCompanyRoleReader(): CompanyRoleReaderInterface
    {
        return new CompanyRoleReader(
            $this->createCompanyReader(),
            $this->getCompanyTypeRoleFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\Reader\CompanyReaderInterface
     */
    protected function createCompanyReader(): CompanyReaderInterface
    {
        return new CompanyReader(
            $this->getCompanyFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyFacadeInterface
     */
    protected function getCompanyFacade(): CompaniesCompanyRolesRestApiToCompanyFacadeInterface
    {
        return $this->getProvidedDependency(
            CompaniesCompanyRolesRestApiDependencyProvider::FACADE_COMPANY
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyTypeRoleFacadeInterface
     */
    protected function getCompanyTypeRoleFacade(): CompaniesCompanyRolesRestApiToCompanyTypeRoleFacadeInterface
    {
        return $this->getProvidedDependency(
            CompaniesCompanyRolesRestApiDependencyProvider::FACADE_COMPANY_TYPE_ROLE
        );
    }
}
