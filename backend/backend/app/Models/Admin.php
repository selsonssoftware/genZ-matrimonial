<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';

    public const CREATED_AT = 'created_date';

    public const UPDATED_AT = 'updated_date';

    protected $guarded = [];

    protected $hidden = [
        'password',
        'reset_token',
    ];

    public function getEmailAttribute(): ?string
    {
        return $this->attributes['mailid'] ?? null;
    }

    public function setEmailAttribute(string $email): void
    {
        $this->attributes['mailid'] = $email;
    }

    public function getRoleAttribute(): string
    {
        return $this->attributes['role'] ?? 'admin';
    }
}
