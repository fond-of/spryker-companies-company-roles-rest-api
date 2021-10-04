<?php

namespace FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\CompanyRole;

use Codeception\Test\Unit;
use FondOfSpryker\Client\CompaniesCompanyRolesRestApi\CompaniesCompanyRolesRestApiClientInterface;
use FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\Mapper\CompaniesCompanyRolesMapperInterface;
use FondOfSpryker\Shared\CompaniesCompanyRolesRestApi\CompaniesCompanyRolesRestApiConfig;
use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\RestCompanyRoleRequestTransfer;
use Generated\Shared\Transfer\RestCompanyRoleResponseTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestUserTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\Response;

class CompanyRoleReaderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\Mapper\CompaniesCompanyRolesMapperInterface
     */
    protected $companiesCompanyRolesMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Company\CompanyClientInterface
     */
    protected $clientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestUserTransfer
     */
    protected $restUserTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyRoleCollectionTransfer
     */
    protected $companyRoleCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject[]|\Generated\Shared\Transfer\CompanyRoleTransfer[]
     */
    protected $companyRoleTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyRoleResponseTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyRoleResponseTransferMock;

    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\CompanyRole\CompanyRoleReader
     */
    protected $companyRoleReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesCompanyRolesMapperMock = $this->getMockBuilder(CompaniesCompanyRolesMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(CompaniesCompanyRolesRestApiClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restUserTransferMock = $this->getMockBuilder(RestUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleCollectionTransferMock = $this->getMockBuilder(CompanyRoleCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleTransferMocks = [
            $this->getMockBuilder(CompanyRoleTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restCompanyRoleResponseTransferMock = $this->getMockBuilder(RestCompanyRoleResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleReader = new CompanyRoleReader(
            $this->restResourceBuilderMock,
            $this->companiesCompanyRolesMapperMock,
            $this->clientMock
        );
    }

    /**
     * @return void
     */
    public function testFindCompanyRolesByCompanyId(): void
    {
        $companyUuid = '5481f335-a719-42e4-87c5-a1f78678d437';
        $idCustomer = 1;

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('findParentResourceByType')
            ->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn($companyUuid);

        $this->restUserTransferMock->expects(static::atLeastOnce())
            ->method('getSurrogateIdentifier')
            ->willReturn($idCustomer);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('getCompanyRolesByRestCompanyRoleRequest')
            ->with(
                static::callback(
                    static function (RestCompanyRoleRequestTransfer $restCompanyRoleRequestTransfer) use ($companyUuid, $idCustomer) {
                        return $restCompanyRoleRequestTransfer->getIdCustomer() === $idCustomer
                            && $restCompanyRoleRequestTransfer->getCompanyUuid() === $companyUuid;
                    }
                )
            )->willReturn($this->restCompanyRoleResponseTransferMock);

        $this->restCompanyRoleResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccess')
            ->willReturn(true);

        $this->restCompanyRoleResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyRoleCollection')
            ->willReturn($this->companyRoleCollectionTransferMock);

        $this->companyRoleCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getRoles')
            ->willReturn($this->companyRoleTransferMocks);

        $this->companiesCompanyRolesMapperMock->expects(static::atLeastOnce())
            ->method('mapCompanyRolesResource')
            ->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('setPayload')
            ->willReturn($this->restResourceMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->companyRoleReader->findCompanyRolesByCompanyId($this->restRequestMock)
        );
    }

    /**
     * @return void
     */
    public function testFindCompanyRolesByCompanyIdAccessDenied(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getRestUser')
            ->willReturn(null);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addError')
            ->with(
                static::callback(
                    static function (RestErrorMessageTransfer $restErrorMessageTransfer) {
                        return $restErrorMessageTransfer->getCode() === CompaniesCompanyRolesRestApiConfig::RESPONSE_CODE_ACCESS_DENIED
                            && $restErrorMessageTransfer->getStatus() === Response::HTTP_FORBIDDEN
                            && $restErrorMessageTransfer->getDetail() === CompaniesCompanyRolesRestApiConfig::RESPONSE_DETAILS_ACCESS_DENIED;
                    }
                )
            )->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->companyRoleReader->findCompanyRolesByCompanyId($this->restRequestMock)
        );
    }
}
