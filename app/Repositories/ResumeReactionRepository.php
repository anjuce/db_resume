<?php

namespace App\Repositories;

use App\Models\ResumeReaction;

class ResumeReactionRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAll(): array|\Illuminate\Database\Eloquent\Collection
    {
        return ResumeReaction::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id): mixed
    {
        return ResumeReaction::find($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return ResumeReaction::create($data);
    }

    /**
     * @param ResumeReaction $reaction
     * @param array $data
     * @return ResumeReaction
     */
    public function update(ResumeReaction $reaction, array $data): ResumeReaction
    {
        $reaction->update($data);
        return $reaction;
    }

    /**
     * @param ResumeReaction $reaction
     * @return void
     */
    public function delete(ResumeReaction $reaction)
    {
        $reaction->delete();
    }
}
