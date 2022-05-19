<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model {
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author_id',
    ];

    public function author(): BelongsTo {
        return $this->belongsTo(User::class, "author_id");
    }

    public function isAuthor(User $user): bool {
        return $this->author_id === $user->id;
    }
}
