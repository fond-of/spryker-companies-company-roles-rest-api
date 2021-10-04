<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\CompanyRole;

use FondOfSpryker\Client\CompaniesCompanyRolesRestApi\CompaniesCompanyRolesRestApiClientInterface;
use FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\Mapper\CompaniesCompanyRolesMapperInterface;
use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use FondOfSpryker\Shared\CompaniesCompanyRolesRestApi\CompaniesCompanyRolesRestApiConfig;
use Generated\Shared\Transfer\RestCompanyRoleRequestTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\Response;

final class CompanyRoleReader implements CompanyRoleReaderInterface
{
    /**
     * @var \FondOfSpryker\Client\CompaniesCompanyRolesRestApi\CompaniesCompanyRolesRestApiClientInterface
     */
    protected $client;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    private $restResourceBuilder;

    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\Mapper\CompaniesCompanyRolesMapperInterface
     */
    private $companiesCompanyRolesMapper;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\Mapper\CompaniesCompanyRolesMapperInterface $companiesCompanyRolesMapper
     * @param \FondOfSpryker\Client\CompaniesCompanyRolesRestApi\CompaniesCompanyRolesRestApiClientInterface $client
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        CompaniesCompanyRolesMapperInterface $companiesCompanyRolesMapper,
        CompaniesCompanyRolesRestApiClientInterface $client
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->companiesCompanyRolesMapper = $companiesCompanyRolesMapper;
        $this->client = $client;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function findCompanyRolesByCompanyId(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        if ($restRequest->getRestUser() === null) {
            return $this->addAccessDeniedError($restResponse);
        }

        $restCompanyRoleRequestTransfer = (new RestCompanyRoleRequestTransfer())
            ->setCompanyUuid($this->findCompanyIdentifier($restRequest))
            ->setIdCustomer($restRequest->getRestUser()->getSurrogateIdentifier());

        $restCompanyRoleResponseTransfer = $this->client->getCompanyRolesByRestCompanyRoleRequest($restCompanyRoleRequestTransfer);

        $companyRolesCollectionTransfer = $restCompanyRoleResponseTransfer->getCompanyRoleCollection();

        if ($companyRolesCollectionTransfer === null || !$restCompanyRoleResponseTransfer->getIsSuccess()) {
            return $restResponse;
        }

        foreach ($companyRolesCollectionTransfer->getRoles() as $companyRoleTransfer) {
            $resource = $this->companiesCompanyRolesMapper
                ->mapCompanyRolesResource($companyRoleTransfer)
                ->setPayload($companyRoleTransfer);

            $restResponse->addResource($resource);
        }

        return $restResponse;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return string|null
     */
    protected function findCompanyIdentifier(RestRequestInterface $restRequest): ?string
    {
        $companyResource = $restRequest->findParentResourceByType(CompaniesRestApiConfig::RESOURCE_COMPANIES);
        if ($companyResource !== null) {
            return $companyResource->getId();
        }

        return null;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addAccessDeniedError(RestResponseInterface $restResponse): RestResponseInterface
    {
        $restErrorTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompaniesCompanyRolesRestApiConfig::RESPONSE_CODE_ACCESS_DENIED)
            ->setStatus(Response::HTTP_FORBIDDEN)
            ->setDetail(CompaniesCompanyRolesRestApiConfig::RESPONSE_DETAILS_ACCESS_DENIED);

        return $restResponse->addError($restErrorTransfer);
    }
}
