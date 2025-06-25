<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Muestra el perfil del usuario autenticado.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user()->load(['bookings.package', 'packages']);
        return view('profile.index', compact('user'));
    }

    /**
     * Muestra el formulario para editar el perfil del usuario autenticado.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Actualiza el perfil del usuario autenticado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Validar los datos del formulario
        $validated = $request->validate([
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
            'skills' => 'nullable|string|max:500',
            'avatar' => 'nullable|image|max:2048', // Máximo 2MB
        ]);

        // Procesar las habilidades (convertir string a array)
        if (isset($validated['skills'])) {
            $validated['skills'] = array_map('trim', explode(',', $validated['skills']));
        }

        // Procesar la imagen de perfil si se subió una
        if ($request->hasFile('avatar')) {
            // Eliminar avatar anterior si existe
            if ($user->profile && $user->profile->avatar) {
                Storage::delete($user->profile->avatar);
            }
            
            // Guardar nueva imagen
            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $path;
        }

        // Actualizar o crear el perfil
        if ($user->profile) {
            $user->profile->update($validated);
        } else {
            $user->profile()->create($validated);
        }

        return redirect()->route('profile.index')
            ->with('success', 'Perfil actualizado correctamente.');
    }
}
