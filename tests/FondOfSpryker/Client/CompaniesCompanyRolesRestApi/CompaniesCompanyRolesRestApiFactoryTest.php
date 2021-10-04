<?php

namespace FondOfSpryker\Client\CompaniesCompanyRolesRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompaniesCompanyRolesRestApi\Dependency\Client\CompaniesCompanyRolesRestApiToZedRequestClientInterface;
use FondOfSpryker\Client\CompaniesCompanyRolesRestApi\Zed\CompaniesCompanyRolesRestApiStub;
use Spryker\Client\Kernel\Container;

class CompaniesCompanyRolesRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\CompaniesCompanyRolesRestApi\CompaniesCompanyRolesRestApiFactory
     */
    protected $companiesCompanyRolesRestApiFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CompaniesCompanyRolesRestApi\Dependency\Client\CompaniesCompanyRolesRestApiToZedRequestClientInterface
     */
    protected $zedRequestClientMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(CompaniesCompanyRolesRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyRolesRestApiFactory = new CompaniesCompanyRolesRestApiFactory();
        $this->companiesCompanyRolesRestApiFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompaniesCompanyRolesRestApiStub(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(CompaniesCompanyRolesRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        static::assertInstanceOf(
            CompaniesCompanyRolesRestApiStub::class,
            $this->companiesCompanyRolesRestApiFactory->createCompaniesCompanyRolesRestApiStub()
        );
    }
}
