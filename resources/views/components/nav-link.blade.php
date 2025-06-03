@props(['active' => false, 'href' => '#'])

<a href="{{ $href }}" @class([
    'block px-4 py-3 text-sm transition-all',
    'bg-blue-900 text-white' => $active,
    'text-blue-200 hover:bg-blue-700 hover:text-white' => !$active,
])>
    {{ $slot }}
</a>