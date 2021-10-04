<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\CompaniesCompanyRolesRestApi;

use FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\CompanyRole\CompanyRoleReader;
use FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\CompanyRole\CompanyRoleReaderInterface;
use FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\Mapper\CompaniesCompanyRolesMapper;
use FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\Mapper\CompaniesCompanyRolesMapperInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfSpryker\Client\CompaniesCompanyRolesRestApi\CompaniesCompanyRolesRestApiClientInterface getClient()
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
            $this->getClient()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\Mapper\CompaniesCompanyRolesMapperInterface
     */
    protected function createCompaniesCompanyRolesMapper(): CompaniesCompanyRolesMapperInterface
    {
        return new CompaniesCompanyRolesMapper(
            $this->getResourceBuilder()
        );
    }
}
