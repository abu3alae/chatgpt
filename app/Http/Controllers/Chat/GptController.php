<?php

namespace App\Http\Controllers\Chat;

use App\Models\Gpt;
use Inertia\Inertia;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use App\Http\Controllers\Controller;
use App\Http\Requests\GptStoreRequest;

/**
 * @property Gpt $gpt
 */
class GptController extends Controller
{
    public function __construct(Gpt $gpt)
    {
        //$this->middleware('auth');
        $this->gpt = $gpt;
    }

    public function index(string $id = null)
    {
        return Inertia::render('Chat/Gpt/Index', [
            'chat' => fn() => $id ? Gpt::findOrFail($id) : null,
            'messages' => Gpt::where('user_id', auth()->id())->latest()->get(),
        ]);
    }

    public function store(GptStoreRequest $request)
    {
        //dd($request->all());
        $messages[] = [
            'role' => Gpt::USER_ROLE,
            'content' => $request->prompt,
        ];

        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => $messages,
        ]);

        //dd($response);

        $chat = $this->gpt->create([
            'user_id' => auth()->id(),
            'chat_content' => ['role' => Gpt::ASSISTANT_ROLE, 'content' => $response['choices'][0]['message']['content']],
        ]);

        return redirect()->route('chat.gpt', ['id' => $chat->id]);
    }
}
