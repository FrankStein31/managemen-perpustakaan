<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('categorys')
            ->where('is_deleted', 0)
            ->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DB::table('categorys')->insert([
            'name' => $validated['name'],
            'is_deleted' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    public function show($id)
    {
        $category = DB::table('categorys')->find($id);
        return view('categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = DB::table('categorys')->find($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DB::table('categorys')->where('id', $id)->update([
            'name' => $validated['name'],
            'updated_at' => now(),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        DB::table('categorys')->where('id', $id)->update([
            'is_deleted' => 1,
            'deleted_at' => now(),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
