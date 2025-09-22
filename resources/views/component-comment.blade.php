@props(['record'])

<div class="flex items-start gap-2 my-2
    {{ $record->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}">

    {{-- Kalau bukan user yg login, tampil di kiri --}}
    @if ($record->user_id !== auth()->id())
        <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
            {{ substr($record->user->name, 0, 1) }}
        </div>
    @endif

    <div
        class="max-w-xs px-4 py-2 rounded-2xl shadow
        {{ $record->user_id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-200 text-black' }}">
        <div class="text-sm font-semibold">{{ $record->user->name }}</div>
        <div class="text-sm">{{ $record->body }}</div>
        <div class="text-xs text-gray-500 mt-1">{{ $record->created_at->diffForHumans() }}</div>
    </div>

    {{-- Kalau user yg login, tampil di kanan --}}
    @if ($record->user_id === auth()->id())
        <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center">
            {{ substr($record->user->name, 0, 1) }}
        </div>
    @endif
</div>
