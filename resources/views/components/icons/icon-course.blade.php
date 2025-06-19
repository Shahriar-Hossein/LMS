<svg
    {{ $attributes->merge(['class' => 'w-5 h-5']) }}
    fill={{ $fill ?? "#000000" }}
    viewBox="0 0 18 18"
    xmlns="http://www.w3.org/2000/svg"
>
    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
    <g id="SVGRepo_iconCarrier">
        {{-- removed default stroke from here --}}
        <path fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M1 2h16v11H1z"></path>
        <path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M4 5.5v5s3-1 5 0v-5s-2-2-5 0zM9 5.5v5s3-1 5 0v-5s-2-2-5 0z"></path>
        <path fill="#494C4E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M8.5 14l-3 3h7l-3-3z"></path>
    </g>
</svg>
