<?php

namespace FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyTypeRole\Business\CompanyTypeRoleFacadeInterface;
use Generated\Shared\Transfer\AssignableCompanyRoleCriteriaFilterTransfer;
use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;

class CompaniesCompanyRolesRestApiToCompanyTypeRoleFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyTypeRole\Business\CompanyTypeRoleFacadeInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTypeRoleFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\AssignableCompanyRoleCriteriaFilterTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $assignableCompanyRoleCriteriaFilterTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyRoleCollectionTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyRoleCollectionTransferMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Dependency\Facade\CompaniesCompanyRolesRestApiToCompanyTypeRoleFacadeBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyTypeRoleFacadeMock = $this->getMockBuilder(CompanyTypeRoleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->assignableCompanyRoleCriteriaFilterTransferMock = $this->getMockBuilder(AssignableCompanyRoleCriteriaFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleCollectionTransferMock = $this->getMockBuilder(CompanyRoleCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new CompaniesCompanyRolesRestApiToCompanyTypeRoleFacadeBridge(
            $this->companyTypeRoleFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testGetAssignableCompanyRoles(): void
    {
        $this->companyTypeRoleFacadeMock->expects(static::atLeastOnce())
            ->method('getAssignableCompanyRoles')
            ->with($this->assignableCompanyRoleCriteriaFilterTransferMock)
            ->willReturn($this->companyRoleCollectionTransferMock);

        static::assertEquals(
            $this->companyRoleCollectionTransferMock,
            $this->bridge->getAssignableCompanyRoles($this->assignableCompanyRoleCriteriaFilterTransferMock)
        );
    }
}
