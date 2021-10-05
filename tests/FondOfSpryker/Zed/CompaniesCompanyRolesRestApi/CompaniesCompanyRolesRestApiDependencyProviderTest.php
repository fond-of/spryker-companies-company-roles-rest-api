<?php

namespace FondOfSpryker\Zed\CompaniesCompanyRolesRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyFacadeInterface;
use FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyTypeRoleFacadeInterface;
use FondOfSpryker\Zed\CompanyTypeRole\Business\CompanyTypeRoleFacadeInterface;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Company\Business\CompanyFacadeInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class CompaniesCompanyRolesRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Locator
     */
    protected $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Quote\Business\QuoteFacadeInterface
     */
    protected $companyFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\CollaborativeCart\Business\CollaborativeCartFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTypeRoleFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\CompaniesCompanyRolesRestApiDependencyProvider
     */
    protected $companiesCompanyRolesRestApiDependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyFacadeMock = $this->getMockBuilder(CompanyFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTypeRoleFacadeMock = $this->getMockBuilder(CompanyTypeRoleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyRolesRestApiDependencyProvider = new CompaniesCompanyRolesRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['company'], ['companyTypeRole'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturnOnConsecutiveCalls(
                $this->companyFacadeMock,
                $this->companyTypeRoleFacadeMock
            );

        $container = $this->companiesCompanyRolesRestApiDependencyProvider->provideBusinessLayerDependencies(
            $this->containerMock
        );

        static::assertEquals($this->containerMock, $container);

        static::assertInstanceOf(
            CompaniesCompanyRolesRestApiToCompanyFacadeInterface::class,
            $container[CompaniesCompanyRolesRestApiDependencyProvider::FACADE_COMPANY]
        );

        static::assertInstanceOf(
            CompaniesCompanyRolesRestApiToCompanyTypeRoleFacadeInterface::class,
            $container[CompaniesCompanyRolesRestApiDependencyProvider::FACADE_COMPANY_TYPE_ROLE]
        );
    }
}
