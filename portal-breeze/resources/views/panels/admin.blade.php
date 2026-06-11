<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-brand leading-tight">
      {{ __('Panel de Administración') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow sm:rounded-lg p-6">
        Bienvenido, {{ auth()->user()->name }}.
        Tu rol es <strong>{{ auth()->user()->role }}</strong>.
      </div>
    </div>
  </div>
</x-app-layout>
