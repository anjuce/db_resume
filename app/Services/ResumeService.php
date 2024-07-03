<?php

namespace App\Services;

use App\Models\Resume;
use App\Repositories\ResumeRepository;
use Illuminate\Support\Facades\Storage;

class ResumeService
{
    /**
     * @var ResumeRepository
     */
    protected ResumeRepository $resumeRepository;

    /**
     * @param ResumeRepository $resumeRepository
     */
    public function __construct(ResumeRepository $resumeRepository)
    {
        $this->resumeRepository = $resumeRepository;
    }

    /**
     * @param int $companyId
     * @param string $position
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getAllResumes(?int $companyId, ?string $position): array|\Illuminate\Database\Eloquent\Collection
    {
        return $this->resumeRepository->search($companyId, $position);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getResumeById(int $id): mixed
    {
        return $this->resumeRepository->find($id);
    }

    /**
     * @param int $companyId
     * @param string $position
     * @param ?string $resumeText
     * @param \Illuminate\Http\UploadedFile|array|null $resumeFile
     * @return mixed
     */
    public function createResume(int $companyId, string $position, ?string $resumeText, \Illuminate\Http\UploadedFile|array|null $resumeFile): mixed
    {
        $data = [
            'company_id' => $companyId,
            'position' => $position,
            'resume_text' => $resumeText,
            'file_path' => null,
        ];

        if ($resumeFile) {
            $fileName = $resumeFile->getClientOriginalName();
            $filePath = $resumeFile->storeAs('resumes', time() . '-' . $fileName);
            $data['file_path'] = $filePath;
        }

        return $this->resumeRepository->create($data);
    }

    /**
     * @param Resume $resume
     * @param string $position
     * @param ?string $resumeText
     * @param \Illuminate\Http\UploadedFile|array|null $resumeFile
     * @return \App\Models\Resume
     */
    public function updateResume(Resume $resume, string $position, ?string $resumeText, \Illuminate\Http\UploadedFile|array|null $resumeFile): Resume
    {
        $data = [
            'position' => $position,
            'resume_text' => $resumeText,
        ];

        if ($resumeFile) {
            // Delete old file if necessary
            Storage::disk('public')->delete($resume->file_path);

            // Upload new file
            $fileName = $resumeFile->getClientOriginalName();
            $filePath = $resumeFile->storeAs('resumes', $fileName, 'public');
            $data['file_path'] = $filePath;
        }

        return $this->resumeRepository->update($resume, $data);
    }

    /**
     * @param $resume
     * @return void
     */
    public function deleteResume($resume)
    {
        // Delete associated file
        if ($resume->file_path) {
            Storage::disk('public')->delete($resume->file_path);
        }

        $this->resumeRepository->delete($resume);
    }

    /**
     * @return mixed
     */
    public function mostPositiveReactions(): mixed
    {
        return $this->resumeRepository->mostPositiveReactions();
    }
}
