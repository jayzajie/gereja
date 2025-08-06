<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">Sejarah Gereja</h2>

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
            </div>
        </div>
    </div>
</x-app-layout>
