<?php

namespace FondOfSpryker\Client\CompaniesCompanyRolesRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompaniesCompanyRolesRestApi\Zed\CompaniesCompanyRolesRestApiStubInterface;
use Generated\Shared\Transfer\RestCompanyRoleRequestTransfer;
use Generated\Shared\Transfer\RestCompanyRoleResponseTransfer;

class CompaniesCompanyRolesRestApiClientTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CompaniesCompanyRolesRestApi\CompaniesCompanyRolesRestApiFactory
     */
    protected $companiesCompanyRolesRestApiFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CompaniesCompanyRolesRestApi\Zed\CompaniesCompanyRolesRestApiStubInterface
     */
    protected $companiesCompanyRolesRestApiStubMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyRoleRequestTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyRoleRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyRoleResponseTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyRoleResponseTransferMock;

    /**
     * @var \FondOfSpryker\Client\CompaniesCompanyRolesRestApi\CompaniesCompanyRolesRestApiClient
     */
    protected $companiesCompanyRolesRestApiClient;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companiesCompanyRolesRestApiFactoryMock = $this->getMockBuilder(CompaniesCompanyRolesRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyRolesRestApiStubMock = $this->getMockBuilder(CompaniesCompanyRolesRestApiStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleRequestTransferMock = $this->getMockBuilder(RestCompanyRoleRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleResponseTransferMock = $this->getMockBuilder(RestCompanyRoleResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyRolesRestApiClient = new CompaniesCompanyRolesRestApiClient();
        $this->companiesCompanyRolesRestApiClient->setFactory($this->companiesCompanyRolesRestApiFactoryMock);
    }

    /**
     * @return void
     */
    public function testGetCompanyRolesByRestCompanyRoleRequest(): void
    {
        $this->companiesCompanyRolesRestApiFactoryMock->expects(static::atLeastOnce())
            ->method('createCompaniesCompanyRolesRestApiStub')
            ->willReturn($this->companiesCompanyRolesRestApiStubMock);

        $this->companiesCompanyRolesRestApiStubMock->expects(static::atLeastOnce())
            ->method('getCompanyRolesByRestCompanyRoleRequest')
            ->with($this->restCompanyRoleRequestTransferMock)
            ->willReturn($this->restCompanyRoleResponseTransferMock);

        $restCompanyRoleResponseTransferMock = $this->companiesCompanyRolesRestApiClient
            ->getCompanyRolesByRestCompanyRoleRequest($this->restCompanyRoleRequestTransferMock);

        $this->assertEquals(
            $this->restCompanyRoleResponseTransferMock,
            $restCompanyRoleResponseTransferMock
        );
    }
}
