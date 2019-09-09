<?php

declare(strict_types=1);

namespace FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\CompanyRole;

use FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\Mapper\CompaniesCompanyRolesMapperInterface;
use FondOfSpryker\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use FondOfSpryker\Shared\CompaniesCompanyRolesRestApi\CompaniesCompanyRolesRestApiConfig;
use Generated\Shared\Transfer\CompanyRoleCriteriaFilterTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Client\Company\CompanyClientInterface;
use Spryker\Client\CompanyRole\CompanyRoleClientInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\Response;

final class CompanyRoleReader implements CompanyRoleReaderInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    private $restResourceBuilder;

    /**
     * @var \Spryker\Client\Company\CompanyClientInterface
     */
    private $companyClient;

    /**
     * @var \FondOfSpryker\Glue\CompaniesCompanyRolesRestApi\Processor\Mapper\CompaniesCompanyRolesMapperInterface
     */
    private $companiesCompanyRolesMapper;

    /**
     * @var \Spryker\Client\CompanyRole\CompanyRoleClientInterface
     */
    private $companyRoleClient;

    /**
     * CompanyRoleReader constructor.
     *
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \Spryker\Client\Company\CompanyClientInterface $companyClient
     * @param \Spryker\Client\CompanyRole\CompanyRoleClientInterface $companyRoleClient
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        CompaniesCompanyRolesMapperInterface $companiesCompanyRolesMapper,
        CompanyClientInterface $companyClient,
        CompanyRoleClientInterface $companyRoleClient
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->companyClient = $companyClient;
        $this->companyRoleClient = $companyRoleClient;
        $this->companiesCompanyRolesMapper = $companiesCompanyRolesMapper;
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

        $companyTransfer = new CompanyTransfer();
        $companyTransfer->setUuid($this->findCompanyIdentifier($restRequest));
        $companyResponseTransfer = $this->companyClient->findCompanyByUuid($companyTransfer);

        if (!$companyResponseTransfer->getIsSuccessful() || $companyResponseTransfer->getCompanyTransfer() === null) {
            return $this->addCompanyNotFoundError($restResponse);
        }

        $companyRoleCriteriaFilter = new CompanyRoleCriteriaFilterTransfer();
        $companyRoleCriteriaFilter->setIdCompany($companyResponseTransfer->getCompanyTransfer()->getIdCompany());
        $companyRolesCollectionTransfer = $this->companyRoleClient->getCompanyRoleCollection($companyRoleCriteriaFilter);

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

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addCompanyNotFoundError(RestResponseInterface $restResponse): RestResponseInterface
    {
        $restErrorTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompaniesCompanyRolesRestApiConfig::RESPONSE_CODE_COMPANY_NOT_FOUND)
            ->setStatus(Response::HTTP_FORBIDDEN)
            ->setDetail(CompaniesCompanyRolesRestApiConfig::RESPONSE_COMPANY_NOT_FOUND);

        return $restResponse->addError($restErrorTransfer);
    }
}
