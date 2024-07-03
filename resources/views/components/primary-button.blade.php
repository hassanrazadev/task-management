@props([
    'dom' => 'button',
    'url' => ''
])

@if($dom == 'button')
    <button {{$attributes->merge(['class' => 'py-2 px-3 bg-gray-900 text-white rounded hover:cursor-pointer hover:bg-gray-800'])}}>
        {{ $slot }}
    </button>
@else
    <a href="{{ $url }}" {{$attributes->merge(['class' => 'py-2 px-3 bg-gray-900 text-white rounded hover:cursor-pointer hover:bg-gray-800'])}}>
        {{ $slot }}
    </a>
@endif
