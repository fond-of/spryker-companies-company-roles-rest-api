<?php

namespace FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\CompaniesCompanyRolesRestApiFacade;
use Generated\Shared\Transfer\RestCompanyRoleRequestTransfer;
use Generated\Shared\Transfer\RestCompanyRoleResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class GatewayControllerTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Business\CompaniesCompanyRolesRestApiFacade
     */
    protected $companiesCompanyRolesRestApiFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyRoleRequestTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyRoleRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyRoleResponseTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyRoleResponseTransferMock;

    /**
     * @var \FondOfSpryker\Zed\CompaniesCompanyRolesRestApi\Communication\Controller\GatewayController
     */
    protected $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companiesCompanyRolesRestApiFacadeMock = $this->getMockBuilder(CompaniesCompanyRolesRestApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleRequestTransferMock = $this->getMockBuilder(RestCompanyRoleRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleResponseTransferMock = $this->getMockBuilder(RestCompanyRoleResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new class ($this->companiesCompanyRolesRestApiFacadeMock) extends GatewayController {
            /**
             * @var \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected $companiesCompanyRolesRestApiFacade;

            /**
             *  constructor.
             *
             * @param \Spryker\Zed\Kernel\Business\AbstractFacade $facade
             */
            public function __construct(AbstractFacade $facade)
            {
                $this->companiesCompanyRolesRestApiFacade = $facade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
            {
                return $this->companiesCompanyRolesRestApiFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testGetCompanyRolesByRestCompanyRoleRequestAction(): void
    {
        $this->companiesCompanyRolesRestApiFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyRolesByRestCompanyRoleRequest')
            ->with($this->restCompanyRoleRequestTransferMock)
            ->willReturn($this->restCompanyRoleResponseTransferMock);

        static::assertEquals(
            $this->restCompanyRoleResponseTransferMock,
            $this->gatewayController->getCompanyRolesByRestCompanyRoleRequestAction(
                $this->restCompanyRoleRequestTransferMock
            )
        );
    }
}
