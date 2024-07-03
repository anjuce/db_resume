<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResumeReaction\ResumeReactionRequest;
use App\Services\ResumeReactionService;

class ResumeReactionController extends Controller
{
    /**
     * @var ResumeReactionService
     */
    protected ResumeReactionService $service;

    /**
     * @param ResumeReactionService $service
     */
    public function __construct(ResumeReactionService $service)
    {
        $this->service = $service;
    }

    /**
     * @return array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function index()
    {
        return $this->service->getAll();
    }

    /**
     * @param ResumeReactionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ResumeReactionRequest $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validated();

        $reaction = $this->service->create($validatedData);

        return response()->json($reaction, 201);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $reaction = $this->service->find($id);

        if (!$reaction) {
            return response()->json(['error' => 'Reaction not found'], 404);
        }

        return response()->json($reaction);
    }

    /**
     * @param ResumeReactionRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ResumeReactionRequest $request, int $id): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validated();

        $reaction = $this->service->find($id);

        if (!$reaction) {
            return response()->json(['error' => 'Reaction not found'], 404);
        }

        $updatedReaction = $this->service->update($reaction, $validatedData);

        return response()->json($updatedReaction, 200);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(int $id): \Illuminate\Http\JsonResponse
    {
        $reaction = $this->service->find($id);

        if (!$reaction) {
            return response()->json(['error' => 'Reaction not found'], 404);
        }

        $this->service->delete($reaction);

        return response()->json(null, 204);
    }
}
