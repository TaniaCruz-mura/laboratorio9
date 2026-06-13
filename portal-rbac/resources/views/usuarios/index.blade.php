<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administración de usuarios y roles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif

                <table class="w-full text-left">
                    <thead>
                        <tr>
                            <th class="py-2">Usuario</th>
                            <th class="py-2">Email</th>
                            <th class="py-2">Roles</th>
                            <th class="py-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr class="border-t">
                                <form action="{{ route('usuarios.roles.update', $usuario) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <td class="py-2">{{ $usuario->name }}</td>
                                    <td class="py-2">{{ $usuario->email }}</td>
                                    <td class="py-2">
                                        @foreach ($roles as $role)
                                            <label class="mr-3">
                                                <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                                    {{ $usuario->hasRole($role->name) ? 'checked' : '' }}>
                                                {{ $role->name }}
                                            </label>
                                        @endforeach
                                    </td>
                                    <td class="py-2">
                                        <button type="submit" class="text-blue-600">Guardar</button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>