<?php

namespace App\Livewire;

use App\Events\MessageEvent;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatComponent extends Component
{
    public $message;
    public $conversations = [];

    public function mount()
    {
        $messages = Message::all();

        foreach ($messages as $message) {
            $this->conversations[] = [
                'username' => $message->user->name,
                'message'  => $message->message,
            ];
        }
    }

    #[On('echo:chat-channel,MessageEvent')]
    public function listenForMessage($data)
    {
        $this->conversations[] = [
            'username' => $data['user']['name'],
            'message'  => $data['message'],
        ];
    }

    public function submitMessage()
    {
        // dispatch the event
        MessageEvent::dispatch(Auth::user(), $this->message);

        // reset the input on the livewire template
        $this->reset('message');
    }

    public function render()
    {
        return view('livewire.chat-component');
    }
}
