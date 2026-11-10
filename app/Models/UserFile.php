<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserFile extends Model
{
    use HasFactory;

    protected $table = 'files';

    protected $fillable = ['user_id', 'original_name', 'path', 'extension', 'mime_type', 'size'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getIconAttribute(): array
    {
        return match (strtolower((string) $this->extension)) {
            'doc', 'docx'                              => ['bi-file-earmark-word', 'text-primary'],
            'xls', 'xlsx', 'csv'                       => ['bi-file-earmark-excel', 'text-success'],
            'ppt', 'pptx'                              => ['bi-file-earmark-ppt', 'text-danger'],
            'pdf'                                      => ['bi-file-earmark-pdf', 'text-danger'],
            'png', 'jpg', 'jpeg', 'gif', 'svg', 'webp' => ['bi-file-earmark-image', 'text-info'],
            'mp3', 'wav', 'flac', 'ogg'                => ['bi-file-earmark-music', 'text-warning'],
            'mp4', 'avi', 'mkv', 'mov'                 => ['bi-file-earmark-play', 'text-warning'],
            'zip', 'rar', '7z', 'tar', 'gz'            => ['bi-file-earmark-zip', 'text-secondary'],
            'txt', 'md'                                => ['bi-file-earmark-text', 'text-secondary'],
            default                                    => ['bi-file-earmark', 'text-secondary'],
        };
    }
}
