<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request): RedirectResponse
    {
        return match ($request->user()->role) {
            'admin'   => redirect()->route('admin.panel'),
            'docente' => redirect()->route('docente.panel'),
            default   => redirect()->route('estudiante.panel'),
        };
    }
}