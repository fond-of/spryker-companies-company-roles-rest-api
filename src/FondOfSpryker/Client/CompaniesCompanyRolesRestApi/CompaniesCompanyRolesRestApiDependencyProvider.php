<?php

namespace FondOfSpryker\Client\CompaniesCompanyRolesRestApi;

use FondOfSpryker\Client\CompaniesCompanyRolesRestApi\Dependency\Client\CompaniesCompanyRolesRestApiToZedRequestClientBridge;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class CompaniesCompanyRolesRestApiDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_ZED_REQUEST = 'CLIENT_ZED_REQUEST';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);

        return $this->addZedRequestClient($container);
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addZedRequestClient(Container $container): Container
    {
        $container->set(static::CLIENT_ZED_REQUEST, static function (Container $container) {
            return new CompaniesCompanyRolesRestApiToZedRequestClientBridge(
                $container->getLocator()->zedRequest()->client()
            );
        });

        return $container;
    }
}
