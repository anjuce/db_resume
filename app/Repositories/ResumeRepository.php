<?php

namespace App\Repositories;

use App\Models\Resume;

class ResumeRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function all()
    {
        return Resume::all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id): mixed
    {
        return Resume::findOrFail($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return Resume::create($data);
    }

    /**
     * @param Resume $resume
     * @param array $data
     * @return Resume
     */
    public function update(Resume $resume, array $data): Resume
    {
        $resume->update($data);
        return $resume;
    }

    /**
     * @param Resume $resume
     * @return void
     */
    public function delete(Resume $resume)
    {
        $resume->delete();
    }

    public function mostPositiveReactions()
    {
        return Resume::withCount(['reactions as positive_reactions_count' => function ($query) {
            $query->where('is_positive', 1);
        }])->orderBy('positive_reactions_count', 'desc')->first();
    }

    /**
     * @param $companyId
     * @param $position
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function search($companyId = null, $position = null): \Illuminate\Database\Eloquent\Collection|array
    {
        $query = Resume::query();

        if (!is_null($companyId)) {
            $query->where('company_id', $companyId);
        }

        if (!is_null($position)) {
            $query->where('position', 'like', "%{$position}%");
        }

        return $query->get();
    }
}
