@extends('layouts.admin')

@section('main-content')
    <h1>Create Book</h1>
    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" name="author" id="author" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="publisher">Publisher</label>
            <input type="text" name="publisher" id="publisher" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="publication_year">Publication Year</label>
            <input type="number" name="publication_year" id="publication_year" class="form-control">
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description_book">Description</label>
            <textarea name="description_book" id="description_book" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control-file">
        </div>
        <div class="form-group">
            <label for="pdf_file">PDF File</label>
            <input type="file" name="pdf_file" id="pdf_file" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
