<?php

namespace FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;

class CompaniesCompanyRolesMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\Mapper\CompaniesCompanyRolesMapper
     */
    protected $companiesCompanyRolesMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyRoleTransfer
     */
    protected $companyRoleTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceInterfaceMock;

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResourceBuilderInterfaceMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleTransferMock = $this->getMockBuilder(CompanyRoleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceInterfaceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->uuid = 'uuid';

        $this->companiesCompanyRolesMapper = new CompaniesCompanyRolesMapper(
            $this->restResourceBuilderInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testMapCompanyRolesResource(): void
    {
        $this->companyRoleTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->companyRoleTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($this->uuid);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('setPayload')
            ->willReturn($this->restResourceInterfaceMock);

        $this->assertInstanceOf(
            RestResourceInterface::class,
            $this->companiesCompanyRolesMapper->mapCompanyRolesResource(
                $this->companyRoleTransferMock
            )
        );
    }
}
