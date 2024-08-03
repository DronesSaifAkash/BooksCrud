<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
     // GET /books
     public function index(Request $request)
     {
        $query = $request->input('search');
        
        // Filter books by title or author if search query is present
        $books = Book::when($query, function($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', "%{$query}%")
                                ->orWhere('author', 'like', "%{$query}%");
        })->get();
        
        return view('books.index', compact('books'));
     }
 
     // GET /books/create
     public function create()
     {
         return view('books.create');
     }
 
     // POST /books
     public function store(Request $request)
     {
         $validatedData = $request->validate([
             'title' => 'required|string|max:255',
             'author' => 'required|string|max:255',
             'isbn' => 'required|string|unique:books,isbn|max:13',
             'published_date' => 'nullable|date',
             'status' => 'required|in:available,checked_out',
         ]);
 
         Book::create($validatedData);
 
         return redirect()->route('books.index')->with('success', 'Book added successfully.');
     }
 
     // GET /books/{id}
     public function show(Book $book)
     {
         return view('books.show', compact('book'));
     }
 
     // GET /books/{id}/edit
     public function edit(Book $book)
     {
         return view('books.edit', compact('book'));
     }
 
     // PUT/PATCH /books/{id}
     public function update(Request $request, Book $book)
     {
         $validatedData = $request->validate([
             'title' => 'required|string|max:255',
             'author' => 'required|string|max:255',
             'isbn' => 'required|string|unique:books,isbn,' . $book->id . '|max:13',
             'published_date' => 'nullable|date',
             'status' => 'required|in:available,checked_out',
         ]);
 
         $book->update($validatedData);
 
         return redirect()->route('books.index')->with('success', 'Book updated successfully.');
     }
 
     // DELETE /books/{id}
     public function destroy(Book $book)
     {
         $book->delete();
 
         return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
     }
 
     // POST /books/{id}/checkout
     public function checkout($id)
     {
        // Find the book by ID
        $book = Book::findOrFail($id);
        $book->status = 'checked_out';
        $book->update();
 
         return redirect()->route('books.index')->with('success', 'Book checked out successfully.');
     }
 
     // POST /books/{id}/return
     public function return($id)
     {
        // Find the book by ID
        $book = Book::findOrFail($id);
        $book->status = 'available';
        $book->update();

        return redirect()->route('books.index')->with('success', 'Book returned successfully.');

     }
}