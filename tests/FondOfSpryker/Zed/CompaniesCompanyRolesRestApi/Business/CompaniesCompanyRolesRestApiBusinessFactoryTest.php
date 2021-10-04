<?php

namespace FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\Reader\CompanyRoleReader;
use FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\CompaniesCompanyRolesRestApiDependencyProvider;
use FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyFacadeInterface;
use FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyTypeRoleFacadeInterface;
use Spryker\Zed\Kernel\Container;

class CompaniesCompanyRolesRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyFacadeInterface
     */
    protected $companyFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyTypeRoleFacadeInterface
     */
    protected $companyTypeRoleFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\CompaniesCompanyRolesRestApiBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyFacadeMock = $this->getMockBuilder(CompaniesCompanyRolesRestApiToCompanyFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTypeRoleFacadeMock = $this->getMockBuilder(CompaniesCompanyRolesRestApiToCompanyTypeRoleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new CompaniesCompanyRolesRestApiBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyRoleReader(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompaniesCompanyRolesRestApiDependencyProvider::FACADE_COMPANY],
                [CompaniesCompanyRolesRestApiDependencyProvider::FACADE_COMPANY_TYPE_ROLE]
            )->willReturnOnConsecutiveCalls(
                $this->companyFacadeMock,
                $this->companyTypeRoleFacadeMock
            );

        static::assertInstanceOf(
            CompanyRoleReader::class,
            $this->businessFactory->createCompanyRoleReader()
        );
    }
}
