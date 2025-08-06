@props(['title' => 'Sejarah'])

<div>
    <h2 class="text-2xl font-bold mb-4">{{ $title }}</h2>

    <div class="flex space-x-4 mb-6">
        <x-sejarah-nav href="{{ route('sejarah.gereja') }}" :active="request()->routeIs('sejarah.gereja')">
            Sejarah Gereja Toraja
        </x-sejarah-nav>

        <x-sejarah-nav href="{{ route('sejarah.jemaat') }}" :active="request()->routeIs('sejarah.jemaat')">
            Sejarah Gereja Toraja Jemaat Eben-Haezer Selili
        </x-sejarah-nav>
    </div>

    <div class="mt-6">
        {{ $slot }}
    </div>
</div>
