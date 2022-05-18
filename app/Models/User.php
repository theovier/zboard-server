<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail {
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function image(): MorphOne {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function posts(): HasMany {
        return $this->hasMany(Post::class, "author_id");
    }

    public function company(): BelongsTo {
        return $this->belongsTo(Company::class);
    }

    protected function password(): Attribute {
        return Attribute::set(
            set: fn ($value) => Hash::make($value)
        );
    }

    public function isVerified(): bool {
        return $this->email_verified_at != null;
    }
}
