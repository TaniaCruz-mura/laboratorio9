<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Notas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif

                @can('crear-notas')
                    <a href="{{ route('notas.create') }}">Nueva nota</a>
                @endcan

                @foreach ($notas as $nota)
                    <div class="border p-4 rounded mb-2">
                        <h3 class="font-bold">{{ $nota->titulo }}</h3>
                        <p>{{ $nota->contenido }}</p>

                        @if ($nota->user_id === auth()->id() || auth()->user()->can('ver-todas-las-notas'))
                            @can('editar-notas')
                                <a href="{{ route('notas.edit', $nota) }}">Editar</a>
                            @endcan

                            @can('eliminar-notas')
                                <form action="{{ route('notas.destroy', $nota) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Eliminar</button>
                                </form>
                            @endcan
                        @endif
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>