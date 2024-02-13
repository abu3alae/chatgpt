<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GptController extends Controller
{
    public function index(string $gpt = null)
    {
        return Inertia::render('Chat/Gpt/Index');
    }
}
