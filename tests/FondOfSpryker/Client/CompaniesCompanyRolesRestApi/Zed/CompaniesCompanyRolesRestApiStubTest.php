<?php

namespace FondOfSpryker\Client\CompaniesCompanyRolesRestApi\Zed;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompaniesCompanyRolesRestApi\Dependency\Client\CompaniesCompanyRolesRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestCompanyRoleRequestTransfer;
use Generated\Shared\Transfer\RestCompanyRoleResponseTransfer;

class CompaniesCompanyRolesRestApiStubTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\CompaniesCompanyRolesRestApi\Dependency\Client\CompaniesCompanyRolesRestApiToZedRequestClientInterface
     */
    protected $zedRequestClientMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyRoleRequestTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyRoleRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyRoleResponseTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyRoleResponseTransferMock;

    /**
     * @var \FondOfSpryker\Client\CompaniesCompanyRolesRestApi\Zed\CompaniesCompanyRolesRestApiStub
     */
    protected $companiesCompanyRolesRestApiStub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->zedRequestClientMock = $this->getMockBuilder(CompaniesCompanyRolesRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleRequestTransferMock = $this->getMockBuilder(RestCompanyRoleRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleResponseTransferMock = $this->getMockBuilder(RestCompanyRoleResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyRolesRestApiStub = new CompaniesCompanyRolesRestApiStub($this->zedRequestClientMock);
    }

    /**
     * @return void
     */
    public function testClaimCart(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                '/companies-company-roles-rest-api/gateway/get-company-roles-by-rest-company-role-request',
                $this->restCompanyRoleRequestTransferMock
            )->willReturn($this->restCompanyRoleResponseTransferMock);

        $restCompanyRoleResponseTransferMock = $this->companiesCompanyRolesRestApiStub
            ->getCompanyRolesByRestCompanyRoleRequest($this->restCompanyRoleRequestTransferMock);

        $this->assertEquals(
            $this->restCompanyRoleResponseTransferMock,
            $restCompanyRoleResponseTransferMock
        );
    }
}
