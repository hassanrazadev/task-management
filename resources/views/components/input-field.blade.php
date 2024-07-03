@props([
    'name' => 'name',
    'value' => '',
    'label' => null,
    'containerClass' => '',
    'withErrors' => false
])

<div class="flex flex-col gap-2 {{ $containerClass }}">
    @if($label)
        <label>{!! $label !!}</label>
    @endif

    <input {{ $attributes->merge(['class' => 'p-2 border border-gray-400 rounded focus:border-blue-400', 'type' => 'text', 'name' => $name]) }}
           value="{{ $value }}"
    >

    @if($withErrors)
        @error($name)
            <div class="text-red-700">{{ $message }}</div>
        @enderror
    @endif
</div>
