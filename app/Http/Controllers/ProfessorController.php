<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professors = User::all(); // hola
        return view('profesores', compact('professors'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'max_weekly_sessions' => 'required|integer|min:1|max:40',
        ]);

        $validated['password'] = bcrypt('password'); // Default password

        $professor = User::create($validated);
        $professor->assignRole('profesor');

        return redirect()->back()->with('success', 'Profesor creado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $professor = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $professor->id,
            'max_weekly_sessions' => 'required|integer|min:1|max:40',
        ]);

        $professor->update($validated);

        return redirect()->back()->with('success', 'Profesor actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $professor = User::findOrFail($id);
        $professor->delete();

        return redirect()->back()->with('success', 'Profesor eliminado correctamente.');
    }
}
