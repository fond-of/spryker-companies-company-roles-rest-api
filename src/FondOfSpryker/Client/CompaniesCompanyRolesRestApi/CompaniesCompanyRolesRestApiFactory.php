<?php

namespace FondOfSpryker\Client\CompaniesCompanyRolesRestApi;

use FondOfSpryker\Client\CompaniesCompanyRolesRestApi\Dependency\Client\CompaniesCompanyRolesRestApiToZedRequestClientInterface;
use FondOfSpryker\Client\CompaniesCompanyRolesRestApi\Zed\CompaniesCompanyRolesRestApiStub;
use FondOfSpryker\Client\CompaniesCompanyRolesRestApi\Zed\CompaniesCompanyRolesRestApiStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class CompaniesCompanyRolesRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Client\CompaniesCompanyRolesRestApi\Zed\CompaniesCompanyRolesRestApiStubInterface
     */
    public function createCompaniesCompanyRolesRestApiStub(): CompaniesCompanyRolesRestApiStubInterface
    {
        return new CompaniesCompanyRolesRestApiStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfSpryker\Client\CompaniesCompanyRolesRestApi\Dependency\Client\CompaniesCompanyRolesRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): CompaniesCompanyRolesRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(CompaniesCompanyRolesRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
