<?php

namespace App\Services;

use App\Models\Resume;
use App\Models\ResumeReaction;
use App\Repositories\ResumeReactionRepository;
use App\Repositories\ResumeRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ResumeReactionService
{
    /**
     * @var ResumeReactionRepository
     */
    protected ResumeReactionRepository $repository;

    /**
     * @param ResumeReactionRepository $repository
     */
    public function __construct(ResumeReactionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAll(): array|\Illuminate\Database\Eloquent\Collection
    {
        return $this->repository->getAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id): mixed
    {
        return $this->repository->find($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return $this->repository->create($data);
    }

    /**
     * @param ResumeReaction $reaction
     * @param array $data
     * @return ResumeReaction
     */
    public function update(ResumeReaction $reaction, array $data): ResumeReaction
    {
        return $this->repository->update($reaction, $data);
    }

    /**
     * @param ResumeReaction $reaction
     * @return void
     */
    public function delete(ResumeReaction $reaction)
    {
        $this->repository->delete($reaction);
    }
}
