@extends('layouts.admin')

@section('main-content')
    <h1>Books</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary">Create New Book</a>
    
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Image</th>
                <th>PDF</th>
                <th>QR Code</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->publisher }}</td>
                    <td>
                        @if($book->image)
                            <img src="{{ Storage::url($book->image) }}" alt="Book Image" width="100">
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                    <td>
                        @if($book->pdf_file)
                            <a href="{{ Storage::url($book->pdf_file) }}" target="_blank" class="btn btn-info btn-sm">View PDF</a>
                        @else
                            <span>No PDF</span>
                        @endif
                    </td>
                    <td>
                        @if($book->qrcode)
                            <img src="{{ Storage::url($book->qrcode) }}" alt="QR Code" width="100">
                        @else
                            <span>No QR Code</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
