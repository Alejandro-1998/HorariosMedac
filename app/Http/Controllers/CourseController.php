<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('subjects')->get();
        return view('grupos', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'grade' => 'required|in:primero,segundo',
            'year' => 'required|string|max:20',
        ]);

        Course::create($validated);

        return redirect()->back()->with('success', 'Grupo creado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'grade' => 'required|in:primero,segundo',
            'year' => 'required|string|max:20',
        ]);

        $course->update($validated);

        return redirect()->back()->with('success', 'Grupo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->back()->with('success', 'Grupo eliminado correctamente.');
    }
}
