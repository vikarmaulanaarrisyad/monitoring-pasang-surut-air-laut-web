<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::orderBy('name')->get()->pluck('name', 'id');

        return view('post.index', compact('category'));
    }

    public function data(Request $request)
    {
        $query = Post::orderBy('publish_date', 'desc');

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('short_description', function ($query) {
                return $query->title . '<br><small>' . $query->short_description . '</small>';
            })
            ->editColumn('path_image', function ($query) {
                return '<img src="' . Storage::url($query->path_image) . '" class="img-thumbnail">';
            })
            ->editColumn('status', function ($query) {
                return '<span class="badge badge-' . $query->statusColor() . '">' . $query->status . '</span>';
            })
            ->editColumn('aksi', function ($query) {
                return '
                    <div class="btn-group">
                       <a href="' . route('posts.detail', $query->id) . '" class="btn btn-sm btn-primary"><i class="fas fa-search-plus"></i> Detail</a>
                        <button onclick="editForm(`' . route('posts.show', $query->id) . '`)" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i> Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="deleteData(`' . route('posts.destroy', $query->id) . '`,`'.$query->name.'`)"><i class="fas fa-trash-alt"></i> Delete</button>
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
            'title' => 'required|min:3',
            'categories' => 'required',
            'short_description' => 'required',
            'body' => 'required|min:8',
            'publish_date' => 'required|date_format:Y-m-d H:i',
            'status' => 'required|in:publish,archived',
            'path_image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ];

        $message = [
            'title.required' => 'Judul wajib diisi.',
            'title.min' => 'Judul minimal 3 karakter.',
            'short_description.required' => 'Deskripsi singkat wajib diisi.',
            'categories.required' => 'Kategori wajib diisi.',
            'body.required' => 'Konten wajib diisi.',
            'body.min' => 'Konten minimal 8 karakter.',
            'publish_date.required' => 'Tanggal publish wajib diisi.',
            'publish_date.date_format' => 'Tanggal publish harus berformat Y-m-d H:i.',
            'status.required' => 'Status wajib diisi',
            'status.in' => 'Status terpilih tidak sesuai format',
            'path_image.required' => 'File upload tidak boleh kosong.',
            'path_image.mimes' => 'File yang diupload wajib jpg, jpeg, png',
            'path_image.max' => 'File yang diupload maksimal 2MB',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Silakan periksa kembali isian Anda dan coba kembali.'], 422);
        }

        $data = $request->except('path_image', 'categories');
        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'short_description' => $request->short_description,
            'description' => $request->body,
            'publish_date' => $request->publish_date,
            'path_image' => upload('post', $request->file('path_image'), 'post'),
        ];

        $post = Post::create($data);
        $post->category_campaign()->attach($request->categories);

        return response()->json(['message' => 'Data berhasil disimpan.', 'data' => $post]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->body = $post->description;
        $post->publish_date = date('Y-m-d H:i', strtotime($post->publish_date));
        $post->categories = $post->category_post;
        return response()->json(['data' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function detail(Request $request, $id)
    {
        $posts = Post::findOrfail($id);
        $posts->categories = $posts->category_post;

        return view('post.detail', compact('posts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrfail($id);
        $rules = [
            'title' => 'required|min:3',
            'categories' => 'required',
            'slug' => 'unique:posts,slug,' . $post->id,
            'short_description' => 'required',
            'body' => 'required|min:8',
            'publish_date' => 'required|date_format:Y-m-d H:i',
            'status' => 'required|in:publish,archived',
            'path_image' => 'nullable|mimes:png,jpg,jpeg|max:2048'
        ];

        $message = [
            'title.required' => 'Judul wajib diisi.',
            'title.min' => 'Judul minimal 3 karakter.',
            'short_description.required' => 'Deskripsi singkat wajib diisi.',
            'categories.required' => 'Kategori wajib diisi.',
            'body.required' => 'Konten wajib diisi.',
            'body.min' => 'Konten minimal 8 karakter.',
            'publish_date.required' => 'Tanggal publish wajib diisi.',
            'publish_date.date_format' => 'Tanggal publish harus berformat Y-m-d H:i.',
            'status.required' => 'Status wajib diisi',
            'status.in' => 'Status terpilih tidak sesuai format',
            'path_image.required' => 'File upload tidak boleh kosong.',
            'path_image.mimes' => 'File yang diupload wajib jpg, jpeg, png',
            'path_image.max' => 'File yang diupload maksimal 2MB',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Silakan periksa kembali isian Anda dan coba kembali.'], 422);
        }

        $data = $request->except('path_image', 'categories');
        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'short_description' => $request->short_description,
            'description' => $request->body,
            'publish_date' => $request->publish_date,
            'status' => $request->status,
        ];
        if ($request->hasFile('path_image')) {
            if (Storage::disk('public')->exists($post->path_image)) {
                Storage::disk('public')->delete($post->path_image);
            }

            $data['path_image'] = upload('post', $request->file('path_image'), 'post');
        }

        $post->update($data);
        $post->category_post()->sync($request->categories);

        return response()->json(['data' => $post, 'message' => 'Postingan berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $post = Post::findOrfail($id);
        if (Storage::disk('public')->exists($post->path_image)) {
            Storage::disk('public')->delete($post->path_image);
        }

        $post->delete();

        return response()->json(['data' => null, 'message' => 'Postingan berhasil dihapus']);
    }
}
