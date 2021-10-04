<?php

namespace FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\Reader\CompanyRoleReaderInterface;
use Generated\Shared\Transfer\RestCompanyRoleRequestTransfer;
use Generated\Shared\Transfer\RestCompanyRoleResponseTransfer;

class CompaniesCompanyRolesRestApiFacadeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\CompaniesCompanyRolesRestApiBusinessFactory|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\Reader\CompanyRoleReaderInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyRoleReaderMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyRoleRequestTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyRoleRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyRoleResponseTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyRoleResponseTransferMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\CompaniesCompanyRolesRestApiFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompaniesCompanyRolesRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleReaderMock = $this->getMockBuilder(CompanyRoleReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleRequestTransferMock = $this->getMockBuilder(RestCompanyRoleRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleResponseTransferMock = $this->getMockBuilder(RestCompanyRoleResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompaniesCompanyRolesRestApiFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testGetCompanyRolesByRestCompanyRoleRequest(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyRoleReader')
            ->willReturn($this->companyRoleReaderMock);

        $this->companyRoleReaderMock->expects(static::atLeastOnce())
            ->method('getByRestCompanyRoleRequest')
            ->with($this->restCompanyRoleRequestTransferMock)
            ->willReturn($this->restCompanyRoleResponseTransferMock);

        static::assertEquals(
            $this->restCompanyRoleResponseTransferMock,
            $this->facade->getCompanyRolesByRestCompanyRoleRequest($this->restCompanyRoleRequestTransferMock)
        );
    }
}
