<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeReaction extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['resume_id', 'company_id', 'is_positive'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
