<?php

namespace App\Http\Controllers\Chat;

use App\Models\Gpt;
use Inertia\Inertia;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use App\Http\Controllers\Controller;
use App\Http\Requests\GptStoreRequest;
use Illuminate\Http\RedirectResponse;

/**
 * @property Gpt $gpt
 */
class GptController extends Controller
{
    public function __construct(Gpt $gpt)
    {
        $this->middleware('auth');
        $this->gpt = $gpt;
    }

    public function index(string $id = null)
    {
        $chat = fn() => $id ? Gpt::findOrFail($id) : null;
        
        //$chat = $id ? Gpt::findOrFail($id) : null;
        //dd($chat);
        return Inertia::render('Chat/Gpt/Index', [
            'chat' => $chat,
            'messages' => Gpt::where('user_id', auth()->id())->latest()->get(),
        ]);
    }

    public function store(GptStoreRequest $request, int $id = null): RedirectResponse
    {
        //dd($request->all());
        $messages = [];

        if ($id) {
            $chat = Gpt::find($id);
            $messages = $chat->chat_content;
        }

        $messages[] = [
            'role' => Gpt::USER_ROLE,
            'content' => $request->prompt,
        ];

        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => $messages,
        ]);

        //dd($response);

        $messages[] = [
            'role' => Gpt::ASSISTANT_ROLE,
            'content' => $response['choices'][0]['message']['content'],
        ];

        $chat = $this->gpt->updateOrCreate(
            [
                'id' => $id,
                'user_id' => auth()->id(),
            ], 
            [
                'chat_content' => $messages,
            ]
        );

        return redirect()->route('chat.gpt', ['id' => $chat->id]);
    }

    public function destroy(int $id): RedirectResponse
    {
        Gpt::findOrFail($id)->delete();

        return redirect()->route('chat.gpt');
    }
}
