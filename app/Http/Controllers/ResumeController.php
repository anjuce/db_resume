<?php

namespace App\Http\Controllers;

use App\Http\Requests\Resume\CreateResumeRequest;
use App\Http\Requests\Resume\IndexResumeRequest;
use App\Http\Requests\Resume\UpdateResumeRequest;
use App\Services\ResumeService;

class ResumeController extends Controller
{
    /**
     * @var ResumeService
     */
    protected ResumeService $resumeService;

    /**
     * @param ResumeService $resumeService
     */
    public function __construct(ResumeService $resumeService)
    {
        $this->resumeService = $resumeService;
    }

    /**
     * Get resume
     *
     * @param IndexResumeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexResumeRequest $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validated();

        $resumes = $this->resumeService->getAllResumes(
            $validated['company'] ?? null,
            $validated['position'] ?? null
        );

        return response()->json($resumes);
    }

    /**
     * Create resume
     *
     * @param CreateResumeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateResumeRequest $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validated();

        $resume = $this->resumeService->createResume(
            $validated['company_id'],
            $validated['position'],
            $validated['resume_text'] ?? null,
            $request->file('resume_file') ?? null
        );

        return response()->json($resume, 201);
    }

    /**
     * Get resume by Id
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $resume = $this->resumeService->getResumeById($id);
        return response()->json($resume);
    }

    /**
     * Edit resume
     *
     * @param UpdateResumeRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateResumeRequest $request, int $id): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validated();

        $resume = $this->resumeService->getResumeById($id);

        if (!$resume) {
            return response()->json(['error' => 'Resume not found'], 404);
        }

        $resume = $this->resumeService->updateResume(
            $resume,
            $validated['position'],
            $validated['resume_text'] ?? null,
            $request->file('resume_file') ?? null
        );

        return response()->json($resume, 200);
    }

    /**
     * Delete resume
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(int $id): \Illuminate\Http\JsonResponse
    {
        $resume = $this->resumeService->getResumeById($id);
        $this->resumeService->deleteResume($resume);

        return response()->json(null, 204);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function mostPositiveReactions(): \Illuminate\Http\JsonResponse
    {
        $resume = $this->resumeService->mostPositiveReactions();

        return response()->json($resume);
    }
}
