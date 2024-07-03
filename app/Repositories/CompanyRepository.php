<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function all()
    {
        return Company::all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id): mixed
    {
        return Company::findOrFail($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return Company::create($data);
    }

    /**
     * @param Company $company
     * @param array $data
     * @return Company
     */
    public function update(Company $company, array $data): Company
    {
        $company->update($data);
        return $company;
    }

    /**
     * @param Company $company
     * @return void
     */
    public function delete(Company $company)
    {
        $company->delete();
    }

    /**
     * @param ?string $search
     * @return mixed
     */
    public function searchByName(?string $search): mixed
    {
        return Company::where('name', 'like', '%' . $search . '%')->paginate(10);
    }
}
