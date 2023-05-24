<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('category.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function data(Request $request)
    {
        $query = Category::all();

        return datatables($query)
            ->addIndexColumn()
            ->editColumn('aksi', function ($query) {
                return '
                    <div class="btn-group">
                    <button class="btn btn-warning btn-sm" onclick="editForm(`' . route('category.show', $query->id) . '`)"><i class="fas fa-pencil-alt"></i> Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteData(`' . route('category.destroy', $query->id) . '`, `' . $query->name . '`)"><i class="fas fa-trash-alt"></i> Delete</button>
                    </div>
                ';
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:categories,slug',
        ];

        $message = [
            'name.required' => 'Kategori wajib diisi.',
            'name.unique' => 'Kategori sudah ada sebelumnya.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Silakan periksa kembali isian Anda dan coba kembali.'], 422);
        }

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ];

        Category::create($data);

        return response()->json(['message' => 'Data berhasil disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json(['data' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|unique:categories,slug,' . $category->id,
        ];

        $message = [
            'name.required' => 'Kategori wajib diisi.'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Silakan periksa kembali isian Anda dan coba kembali.'], 422);
        }

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ];

        $category->update($data);

        return response()->json(['message' => 'Data berhasil disimpan.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
    }
}
