<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Book;

class ApiBookController extends Controller
{
    /**
     * List all books.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

    /**
     * Get a specific book by ID.
     *
     * @param  Book  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Book $book)
    {
        return response()->json($book);
    }

    /**
     * Create a new book.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|max:13|unique:books',
            'published_date' => 'required|date',
            'status' => 'required|in:available,checked_out',
        ]);

        $book = Book::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Book created successfully.',
            'book' => $book
        ], Response::HTTP_CREATED);
        
    }

    /**
     * Update an existing book.
     *
     * @param  Request  $request
     * @param  Book  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'isbn' => 'sometimes|required|string|max:13|unique:books,isbn,' . $book->id,
            'published_date' => 'sometimes|required|date',
            'status' => 'sometimes|required|in:available,checked_out',
        ]);

        $book->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Book updated successfully.',
            'book' => $book
        ]);
    }

    /**
     * Delete a book.
     *
     * @param  Book  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Book deleted successfully.'
        ], Response::HTTP_NO_CONTENT);
    }

    /**
     * Check out a book.
     *
     * @param  Book  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkout(Book $book)
    {
        $book->status = 'checked_out';
        $book->save();

        return response()->json([
            'success' => true,
            'message' => 'Book checked out successfully.',
            'book' => $book
        ]);
    }

    /**
     * Return a book.
     *
     * @param  Book  $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function return(Book $book)
    {
        $book->status = 'available';
        $book->save();

        return response()->json([
            'success' => true,
            'message' => 'Book returned successfully.',
            'book' => $book
        ]);
    }
}
