<?php

namespace App\Models;

use App\Http\Resources\PostResource;
use Illuminate\Broadcasting\Channel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model {
    use BroadcastsEvents, HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author_id',
    ];

    public function author(): BelongsTo {
        return $this->belongsTo(User::class, "author_id");
    }

    public function comments(): HasMany {
        return $this->hasMany(Comment::class);
    }

    public function isAuthor(User $user): bool {
        return $this->author_id === $user->id;
    }

    public function broadcastOn($event): Channel {
        return new Channel('posts');
    }

    public function broadcastWith($event): array {
        return (new PostResource($this))->resolve();
    }
}
