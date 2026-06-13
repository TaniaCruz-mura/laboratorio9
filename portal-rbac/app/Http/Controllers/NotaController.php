<?php
 
namespace App\Http\Controllers;
 
use App\Http\Requests\StoreNotaRequest;
use App\Http\Requests\UpdateNotaRequest;
use App\Models\Nota;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Attributes\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
 
#[Middleware('auth')]
#[Middleware('permission:ver-notas', only: ['index', 'show'])]
#[Middleware('permission:crear-notas', only: ['create', 'store'])]
#[Middleware('permission:editar-notas', only: ['edit', 'update'])]
#[Middleware('permission:eliminar-notas', only: ['destroy'])]
class NotaController extends Controller
{
    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();
 
        $notas = $user->can('ver-todas-las-notas')
            ? Nota::with('user')->latest()->get()
            : $user->notas()->latest()->get();
 
        return view('notas.index', compact('notas'));
    }
 
    public function create(): View
    {
        return view('notas.create');
    }
 
    public function store(StoreNotaRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $user->notas()->create($request->validated());
 
        return redirect()->route('notas.index')
            ->with('success', 'Nota creada correctamente.');
    }
 
    public function show(Nota $nota): View
    {
        $this->autorizarDueno($nota);
 
        return view('notas.show', compact('nota'));
    }
 
    public function edit(Nota $nota): View
    {
        $this->autorizarDueno($nota);
 
        return view('notas.edit', compact('nota'));
    }
 
    public function update(UpdateNotaRequest $request, Nota $nota): RedirectResponse
    {
        $this->autorizarDueno($nota);
        $nota->update($request->validated());
 
        return redirect()->route('notas.index')
            ->with('success', 'Nota actualizada correctamente.');
    }
 
    public function destroy(Nota $nota): RedirectResponse
    {
        $this->autorizarDueno($nota);
        $nota->delete();
 
        return redirect()->route('notas.index')
            ->with('success', 'Nota eliminada correctamente.');
    }
 
    private function autorizarDueno(Nota $nota): void
    {
        /** @var User $user */
        $user = Auth::user();
 
        abort_unless(
            $nota->user_id === Auth::id()
            || $user->can('ver-todas-las-notas'),
            403
        );
    }
}