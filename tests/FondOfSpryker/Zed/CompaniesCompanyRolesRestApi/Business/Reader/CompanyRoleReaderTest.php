<?php

namespace FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\Reader;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyTypeRoleFacadeInterface;
use Generated\Shared\Transfer\AssignableCompanyRoleCriteriaFilterTransfer;
use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCompanyRoleRequestTransfer;

class CompanyRoleReaderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\Reader\CompanyReaderInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyReaderMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyTypeRoleFacadeInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTypeRoleFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyRoleRequestTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyRoleRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyRoleCollectionTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyRoleCollectionTransferMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\Reader\CompanyRoleReader
     */
    protected $companyRoleReader;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyReaderMock = $this->getMockBuilder(CompanyReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTypeRoleFacadeMock = $this->getMockBuilder(CompaniesCompanyRolesRestApiToCompanyTypeRoleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleRequestTransferMock = $this->getMockBuilder(RestCompanyRoleRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleCollectionTransferMock = $this->getMockBuilder(CompanyRoleCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleReader = new CompanyRoleReader(
            $this->companyReaderMock,
            $this->companyTypeRoleFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testGetByRestCompanyRoleRequest(): void
    {
        $idCompany = 1;
        $idCustomer = 2;

        $this->companyReaderMock->expects(static::atLeastOnce())
            ->method('getByRestCompanyRoleRequest')
            ->with($this->restCompanyRoleRequestTransferMock)
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($idCompany);

        $this->restCompanyRoleRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->companyTypeRoleFacadeMock->expects(static::atLeastOnce())
            ->method('getAssignableCompanyRoles')
            ->with(
                static::callback(
                    static function (
                        AssignableCompanyRoleCriteriaFilterTransfer $assignableCompanyRoleCriteriaFilterTransfer
                    ) use (
                        $idCompany,
                        $idCustomer
                    ) {
                        return $assignableCompanyRoleCriteriaFilterTransfer->getIdCustomer() === $idCustomer
                            && $assignableCompanyRoleCriteriaFilterTransfer->getIdCompany() === $idCompany;
                    }
                )
            )->willReturn($this->companyRoleCollectionTransferMock);

        $restCompanyRoleResponseTransfer = $this->companyRoleReader->getByRestCompanyRoleRequest(
            $this->restCompanyRoleRequestTransferMock
        );

        static::assertTrue($restCompanyRoleResponseTransfer->getIsSuccess());

        static::assertEquals(
            $this->companyRoleCollectionTransferMock,
            $restCompanyRoleResponseTransfer->getCompanyRoleCollection()
        );
    }
}
