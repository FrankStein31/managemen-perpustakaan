<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

class BookController extends Controller
{
    public function index()
    {
        $books = DB::table('books')->where('is_deleted', 0)->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = DB::table('categorys')->where('is_deleted', 0)->get();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'publication_year' => 'nullable|integer',
            'category_id' => 'nullable|integer',
            'description_book' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg',
            'pdf_file' => 'nullable|file|mimes:pdf',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : null;
        $pdfPath = $request->file('pdf_file') ? $request->file('pdf_file')->store('pdfs', 'public') : null;

        $book = DB::table('books')->insertGetId([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'publisher' => $validated['publisher'],
            'publication_year' => $validated['publication_year'],
            'category_id' => $validated['category_id'],
            'description_book' => $validated['description_book'],
            'image' => $imagePath,
            'pdf_file' => $pdfPath,
            'is_deleted' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->generateQrCode($book);

        return redirect()->route('books.index')->with('success', 'Book created successfully');
    }

    public function edit($id)
    {
        $book = DB::table('books')->find($id);
        $categories = DB::table('categorys')->where('is_deleted', 0)->get();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'publication_year' => 'nullable|integer',
            'category_id' => 'nullable|integer',
            'description_book' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg',
            'pdf_file' => 'nullable|file|mimes:pdf',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : DB::table('books')->find($id)->image;
        $pdfPath = $request->file('pdf_file') ? $request->file('pdf_file')->store('pdfs', 'public') : DB::table('books')->find($id)->pdf_file;

        DB::table('books')->where('id', $id)->update([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'publisher' => $validated['publisher'],
            'publication_year' => $validated['publication_year'],
            'category_id' => $validated['category_id'],
            'description_book' => $validated['description_book'],
            'image' => $imagePath,
            'pdf_file' => $pdfPath,
            'is_deleted' => 0,
            'updated_at' => now(),
        ]);

        $this->generateQrCode($id);

        return redirect()->route('books.index')->with('success', 'Book updated successfully');
    }

    public function destroy($id)
    {
        DB::table('books')->where('id', $id)->update(['is_deleted' => 1]);
        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }

    private function generateQrCode($bookId)
    {
        $book = DB::table('books')->find($bookId);
        $qrcode = Builder::create()
            ->writer(new PngWriter())
            ->data($book->category_id)
            ->build();
        $qrcodePath = 'qrcodes/book-' . $bookId . '.png';
        Storage::disk('public')->put($qrcodePath, $qrcode->getString());

        DB::table('books')->where('id', $bookId)->update(['qrcode' => $qrcodePath]);
    }
}
