<div class="
@if($color === 'blue')
bg-blue-50 text-blue-800
@elseif($color === 'green')
bg-green-50 text-green-800
@else
bg-red-50 text-red-800
@endif
rounded w-fit px-2 text-sm">{{ $label }}</div>
