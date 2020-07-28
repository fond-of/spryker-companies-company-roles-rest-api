<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\CompaniesCompanyRolesRestApi;

use FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\CompanyRole\CompanyRoleReader;
use FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\CompanyRole\CompanyRoleReaderInterface;
use FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\Mapper\CompaniesCompanyRolesMapper;
use FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\Mapper\CompaniesCompanyRolesMapperInterface;
use Spryker\Client\Company\CompanyClientInterface;
use Spryker\Client\CompanyRole\CompanyRoleClientInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfSpryker\Client\CompaniesRestApi\CompaniesRestApiClientInterface getClient()
 */
class CompaniesCompanyRolesRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\CompanyRole\CompanyRoleReaderInterface
     */
    public function createCompanyRolesReader(): CompanyRoleReaderInterface
    {
        return new CompanyRoleReader(
            $this->getResourceBuilder(),
            $this->createCompaniesCompanyRolesMapper(),
            $this->getCompanyClient(),
            $this->getCompanyRoleClient(),
            $this->getCompanyRolesRestResponseFilterPlugins()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\Mapper\CompaniesCompanyRolesMapperInterface
     */
    public function createCompaniesCompanyRolesMapper(): CompaniesCompanyRolesMapperInterface
    {
        return new CompaniesCompanyRolesMapper(
            $this->getResourceBuilder()
        );
    }

    /**
     * @throws
     *
     * @return \Spryker\Client\Company\CompanyClientInterface
     */
    public function getCompanyClient(): CompanyClientInterface
    {
        return $this->getProvidedDependency(CompaniesCompanyRolesRestApiDependencyProvider::CLIENT_COMPANY);
    }

    /**
     * @throws
     *
     * @return \Spryker\Client\CompanyRole\CompanyRoleClientInterface
     */
    public function getCompanyRoleClient(): CompanyRoleClientInterface
    {
        return $this->getProvidedDependency(CompaniesCompanyRolesRestApiDependencyProvider::CLIENT_COMPANY_ROLE);
    }

    /**
     * @return \FondOfSpryker\Glue\CompaniesCompanyRolesRestApiExtension\Dependency\Plugin\CompaniesCompanyRolesRestResponseFilterPluginInterface[]
     */
    public function getCompanyRolesRestResponseFilterPlugins(): array
    {
        return $this->getProvidedDependency(CompaniesCompanyRolesRestApiDependencyProvider::PLUGINS_COMPANY_ROLES_REST_RESPONSE_FILTER);
    }
}
