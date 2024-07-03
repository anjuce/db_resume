<?php

namespace App\Services;

use App\Repositories\CompanyRepository;
use App\Models\Company;

class CompanyService
{
    private CompanyRepository $companyRepository;

    /**
     * @param CompanyRepository $companyRepository
     */
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;

    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAllCompanies(): array|\Illuminate\Database\Eloquent\Collection
    {
        return $this->companyRepository->all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getCompanyById(int $id): mixed
    {
        return $this->companyRepository->find($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function createCompany(array $data): mixed
    {
        return $this->companyRepository->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Company
     */
    public function updateCompany(int $id, array $data): Company
    {
        $company = $this->companyRepository->find($id);
        return $this->companyRepository->update($company, $data);
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteCompany(int $id)
    {
        $company = $this->companyRepository->find($id);
        $this->companyRepository->delete($company);
    }

    /**
     * @param ?string $search
     * @return mixed
     */
    public function searchCompanies(?string $search): mixed
    {
        return $this->companyRepository->searchByName($search);
    }
}
