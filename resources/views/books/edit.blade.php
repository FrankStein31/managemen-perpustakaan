@extends('layouts.admin')

@section('main-content')
    <h1>Edit Book</h1>
    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $book->title }}" required>
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" name="author" id="author" class="form-control" value="{{ $book->author }}" required>
        </div>
        <div class="form-group">
            <label for="publisher">Publisher</label>
            <input type="text" name="publisher" id="publisher" class="form-control" value="{{ $book->publisher }}" required>
        </div>
        <div class="form-group">
            <label for="publication_year">Publication Year</label>
            <input type="number" name="publication_year" id="publication_year" class="form-control" value="{{ $book->publication_year }}">
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description_book">Description</label>
            <textarea name="description_book" id="description_book" class="form-control">{{ $book->description_book }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control-file">
            @if($book->image)
                <img src="{{ Storage::url($book->image) }}" alt="{{ $book->title }}" width="100" class="mt-2">
            @endif
        </div>
        <div class="form-group">
            <label for="pdf_file">PDF File</label>
            <input type="file" name="pdf_file" id="pdf_file" class="form-control-file">
            @if($book->pdf_file)
                <a href="{{ Storage::url($book->pdf_file) }}" target="_blank" class="btn btn-info mt-2">View PDF</a>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
