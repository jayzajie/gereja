@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">Profil Gereja</h2>
                    
                    <div class="flex space-x-4 mb-6">
                        <a href="{{ route('sejarah.gereja') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-md focus:outline-none focus:text-gray-700 focus:bg-gray-100 transition duration-150 ease-in-out">
                            Sejarah
                        </a>
                        
                        {{-- <a href="{{ route('struktur-organisasi') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-md focus:outline-none focus:text-gray-700 focus:bg-gray-100 transition duration-150 ease-in-out">
                            Struktur Organisasi
                        </a> --}}
                    </div>

                    <div class="mt-6">
                        <p>Silakan pilih salah satu menu di atas untuk melihat informasi profil gereja.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 