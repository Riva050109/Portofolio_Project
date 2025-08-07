<span
    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $color === 'warning' ? 'bg-yellow-100 text-yellow-800' : '' }} {{ $color === 'success' ? 'bg-green-100 text-green-800' : '' }} {{ $color === 'danger' ? 'bg-red-100 text-red-800' : '' }} {{ $color === 'gray' ? 'bg-gray-100 text-gray-800' : '' }}">
    <svg class="-ml-0.5 mr-1.5 h-4 w-4 {{ $color === 'warning' ? 'text-yellow-400' : '' }} {{ $color === 'success' ? 'text-green-400' : '' }} {{ $color === 'danger' ? 'text-red-400' : '' }} {{ $color === 'gray' ? 'text-gray-400' : '' }}"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="{{ $icon === 'heroicon-o-clock' ? 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' : '' }} {{ $icon === 'heroicon-o-check-circle' ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' : '' }} {{ $icon === 'heroicon-o-x-circle' ? 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M10 14l-2-2m0 0l-2-2m2 2l2-2m2 2l2 2' : '' }} {{ $icon === 'heroicon-o-question-mark-circle' ? 'M8.228 15.667c-.552 0-1.002-.45-.986-1.002l.008-.008a.998.998 0 01.986 1.002zm8.333-3.334a.999.999 0 10-1.414-1.414l-3.536 3.535a.999.999 0 001.414 1.414l3.536-3.535zM12 2a9 9 0 100 18 9 9 0 000-18z' : '' }}">
        </path>
    </svg>
    {{ ucfirst($status) }}
</span>