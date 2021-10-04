<?php

namespace FondOfSpryker\Glue\CompaniesCompanyRolesRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompaniesCompanyRolesRestApi\CompaniesCompanyRolesRestApiClient;
use FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\CompanyRole\CompanyRoleReader;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;

class CompaniesCompanyRolesRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CompaniesCompanyRolesRestApi\CompaniesCompanyRolesRestApiClient
     */
    protected $clientMock;

    /**
     * @var mixed|\PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\CompaniesCompanyRolesRestApiFactory
     */
    protected $companiesCompanyRolesRestApiFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->clientMock = $this->getMockBuilder(CompaniesCompanyRolesRestApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyRolesRestApiFactory = new class (
            $this->restResourceBuilderMock
        ) extends CompaniesCompanyRolesRestApiFactory {
            /**
             * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            protected $restResourceBuilder;

            /**
             * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
             */
            public function __construct(RestResourceBuilderInterface $restResourceBuilder)
            {
                $this->restResourceBuilder = $restResourceBuilder;
            }

            /**
             * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            public function getResourceBuilder(): RestResourceBuilderInterface
            {
                return $this->restResourceBuilder;
            }
        };
        $this->companiesCompanyRolesRestApiFactory->setClient($this->clientMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyRolesReader(): void
    {
        static::assertInstanceOf(
            CompanyRoleReader::class,
            $this->companiesCompanyRolesRestApiFactory->createCompanyRolesReader()
        );
    }
}
