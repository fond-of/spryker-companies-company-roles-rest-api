<?php

namespace FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\Reader;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyFacadeInterface;
use Generated\Shared\Transfer\CompanyResponseTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompanyRoleRequestTransfer;

class CompanyReaderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyFacadeInterface
     */
    protected $companyFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTransfer
     */
    protected $companyTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyResponseTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyRoleRequestTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyRoleRequestTransferMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\Reader\CompanyReader
     */
    protected $companyReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyFacadeMock = $this->getMockBuilder(CompaniesCompanyRolesRestApiToCompanyFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleRequestTransferMock = $this->getMockBuilder(RestCompanyRoleRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyResponseTransferMock = $this->getMockBuilder(CompanyResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyReader = new CompanyReader($this->companyFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetByRestCompanyRoleRequest(): void
    {
        $uuid = 'd9904c66-6c58-44b6-b942-e96bae77ecd0';

        $this->restCompanyRoleRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUuid')
            ->willReturn($uuid);

        $this->companyFacadeMock->expects($this->atLeastOnce())
            ->method('findCompanyByUuid')
            ->with(
                static::callback(
                    static function (CompanyTransfer $companyTransfer) use ($uuid) {
                        return $companyTransfer->getUuid() === $uuid;
                    }
                )
            )
            ->willReturn($this->companyResponseTransferMock);

        $this->companyResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->companyResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyTransfer')
            ->willReturn($this->companyTransferMock);

        static::assertEquals(
            $this->companyTransferMock,
            $this->companyReader->getByRestCompanyRoleRequest($this->restCompanyRoleRequestTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testGetByRestCompanyRoleRequestWithNullableCompanyUuid(): void
    {
        $this->restCompanyRoleRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUuid')
            ->willReturn(null);

        $this->companyFacadeMock->expects($this->never())
            ->method('findCompanyByUuid');

        static::assertEquals(
            null,
            $this->companyReader->getByRestCompanyRoleRequest($this->restCompanyRoleRequestTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testGetByRestCompanyRoleRequestWithNonExisting(): void
    {
        $uuid = 'd9904c66-6c58-44b6-b942-e96bae77ecd0';

        $this->restCompanyRoleRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUuid')
            ->willReturn($uuid);

        $this->companyFacadeMock->expects($this->atLeastOnce())
            ->method('findCompanyByUuid')
            ->with(
                static::callback(
                    static function (CompanyTransfer $companyTransfer) use ($uuid) {
                        return $companyTransfer->getUuid() === $uuid;
                    }
                )
            )
            ->willReturn($this->companyResponseTransferMock);

        $this->companyResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(false);

        static::assertEquals(
            null,
            $this->companyReader->getByRestCompanyRoleRequest($this->restCompanyRoleRequestTransferMock)
        );
    }
}
