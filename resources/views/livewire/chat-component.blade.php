<div>
    <form wire:submit="submitMessage">
        <x-text-input wire:model="message" />
        <button type="submit">Send Message</button>
    </form>
    @foreach ($conversations as $convo)
        <div>{{$convo['username']}}: {{$convo['message']}}</div>
    @endforeach
</div>