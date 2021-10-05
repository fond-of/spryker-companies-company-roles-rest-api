<?php

namespace FondOfSpryker\Zed\CompaniesCompanyRolesRestApi;

use FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyFacadeBridge;
use FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyTypeRoleFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CompaniesCompanyRolesRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_COMPANY = 'FACADE_COMPANY';
    public const FACADE_COMPANY_TYPE_ROLE = 'FACADE_COMPANY_TYPE_ROLE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addCompanyFacade($container);

        return $this->addCompanyTypeRoleFacade($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY] = static function (Container $container) {
            return new CompaniesCompanyRolesRestApiToCompanyFacadeBridge(
                $container->getLocator()->company()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyTypeRoleFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_TYPE_ROLE] = static function (Container $container) {
            return new CompaniesCompanyRolesRestApiToCompanyTypeRoleFacadeBridge(
                $container->getLocator()->companyTypeRole()->facade()
            );
        };

        return $container;
    }
}
