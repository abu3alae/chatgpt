<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gpt extends Model
{
    use HasFactory;

    public const USER_ROLE = 'user';
    public const SYSTEM_ROLE = 'system';
    public const ASSISTANT_ROLE = 'assistant';

    protected $table = 'gpts';

    protected $fillable = [
        'user_id',
        'chat_content',
    ];

    protected $casts = [
        'chat_content' => 'array',
    ];
}
