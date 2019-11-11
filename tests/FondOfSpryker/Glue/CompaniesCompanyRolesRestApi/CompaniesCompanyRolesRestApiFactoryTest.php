<?php

namespace FondOfSpryker\Glue\CompaniesCompanyRolesRestApi;

use Codeception\Test\Unit;
use Spryker\Client\Company\CompanyClientInterface;
use Spryker\Client\CompanyRole\CompanyRoleClientInterface;
use Spryker\Glue\Kernel\Container;

class CompaniesCompanyRolesRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\CompaniesCompanyRolesRestApiFactory
     */
    protected $companiesCompanyRolesRestApiFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Company\CompanyClientInterface
     */
    protected $companyClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\CompanyRole\CompanyRoleClientInterface
     */
    protected $companyRoleClientInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyClientInterfaceMock = $this->getMockBuilder(CompanyClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleClientInterfaceMock = $this->getMockBuilder(CompanyRoleClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyRolesRestApiFactory = new CompaniesCompanyRolesRestApiFactory();
        $this->companiesCompanyRolesRestApiFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testGetCompanyClient(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CompaniesCompanyRolesRestApiDependencyProvider::CLIENT_COMPANY)
            ->willReturn($this->companyClientInterfaceMock);

        $this->assertInstanceOf(
            CompanyClientInterface::class,
            $this->companiesCompanyRolesRestApiFactory->getCompanyClient()
        );
    }

    /**
     * @return void
     */
    public function testGetCompanyRoleClient(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(CompaniesCompanyRolesRestApiDependencyProvider::CLIENT_COMPANY_ROLE)
            ->willReturn($this->companyRoleClientInterfaceMock);

        $this->assertInstanceOf(
            CompanyRoleClientInterface::class,
            $this->companiesCompanyRolesRestApiFactory->getCompanyRoleClient()
        );
    }
}
