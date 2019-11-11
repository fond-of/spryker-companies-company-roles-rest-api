<?php

namespace FondOfSpryker\Glue\CompaniesCompanyRolesRestApi;

use Codeception\Test\Unit;
use Spryker\Glue\Kernel\Container;

class CompaniesCompanyRolesRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\CompaniesCompanyRolesRestApiDependencyProvider
     */
    protected $companiesCompanyRolesRestApiDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyRolesRestApiDependencyProvider = new CompaniesCompanyRolesRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->companiesCompanyRolesRestApiDependencyProvider->provideDependencies(
                $this->containerMock
            )
        );
    }
}
