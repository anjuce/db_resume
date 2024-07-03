<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\CreateCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Http\Requests\Company\IndexCompanyRequest;
use App\Services\CompanyService;

class CompanyController extends Controller
{
    /**
     * @var CompanyService
     */
    protected CompanyService $companyService;

    /**
     * @param CompanyService $companyService
     */
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;

    }

    /**
     * Display a listing of the companies.
     *
     * @param IndexCompanyRequest $request
     * @return mixed
     */
    public function index(IndexCompanyRequest $request): mixed
    {
        $search = $request->input('search');
        return $this->companyService->searchCompanies($search);
    }

    /**
     * Store a newly created company
     *
     * @param CreateCompanyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateCompanyRequest $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validated();

        $company = $this->companyService->createCompany($validatedData);

        return response()->json($company, 201);
    }

    /**
     * Display the company by Id.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->companyService->getCompanyById($id);
    }

    /**
     * Update company
     *
     * @param UpdateCompanyRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCompanyRequest $request, int $id): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validated();
        try {
            $company = $this->companyService->updateCompany($id, $validatedData);
            return response()->json($company, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update company'], 500);
        }

    }

    /**
     * Remove company
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(int $id): \Illuminate\Http\JsonResponse
    {
        $this->companyService->deleteCompany($id);

        return response()->json(null, 204);
    }

}
