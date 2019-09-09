<?php

declare(strict_types=1);

namespace FondOfSpryker\Glue\CompaniesCompanyRolesRestApi;

use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

class CompaniesCompanyRolesRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_COMPANY = 'CLIENT_COMPANY';
    public const CLIENT_COMPANY_ROLE = 'CLIENT_COMPANY_ROLE';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addCompanyClient($container);
        $container = $this->addCompanyRoleClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addCompanyClient(Container $container): Container
    {
        $container[static::CLIENT_COMPANY] = static function (Container $container) {
            return $container->getLocator()->company()->client();
        };

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addCompanyRoleClient(Container $container): Container
    {
        $container[static::CLIENT_COMPANY_ROLE] = static function (Container $container) {
            return $container->getLocator()->companyRole()->client();
        };

        return $container;
    }
}
