<?php

namespace FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\CompaniesCompanyRolesRestApiConfig;
use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use Generated\Shared\Transfer\RestCompanyRoleAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class CompaniesCompanyRolesResourceRoutePluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Plugin\CompaniesCompanyRolesResourceRoutePlugin
     */
    protected $companiesCompanyRolesResourceRoutePlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    protected $resourceRouteCollectionInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->resourceRouteCollectionInterfaceMock = $this->getMockBuilder(ResourceRouteCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyRolesResourceRoutePlugin = new CompaniesCompanyRolesResourceRoutePlugin();
    }

    /**
     * @return void
     */
    public function testConfigure(): void
    {
        $this->assertInstanceOf(
            ResourceRouteCollectionInterface::class,
            $this->companiesCompanyRolesResourceRoutePlugin->configure(
                $this->resourceRouteCollectionInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetResourceType(): void
    {
        $this->assertSame(
            CompaniesCompanyRolesRestApiConfig::RESOURCE_COMPANIES_COMPANY_ROLES,
            $this->companiesCompanyRolesResourceRoutePlugin->getResourceType()
        );
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        $this->assertSame(
            CompaniesCompanyRolesRestApiConfig::CONTROLLER_COMPANIES_COMPANY_ROLES,
            $this->companiesCompanyRolesResourceRoutePlugin->getController()
        );
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        $this->assertSame(
            RestCompanyRoleAttributesTransfer::class,
            $this->companiesCompanyRolesResourceRoutePlugin->getResourceAttributesClassName()
        );
    }

    /**
     * @return void
     */
    public function testGetParentResourceType(): void
    {
        $this->assertSame(
            CompaniesRestApiConfig::RESOURCE_COMPANIES,
            $this->companiesCompanyRolesResourceRoutePlugin->getParentResourceType()
        );
    }
}
