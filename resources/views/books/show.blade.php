<!-- resources/views/books/show.blade.php -->

<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Book Details</h1>

        <div class="bg-white p-6 border border-gray-200 rounded-lg">
            <p><strong>ID:</strong> {{ $book->id }}</p>
            <p><strong>Title:</strong> {{ $book->title }}</p>
            <p><strong>Author:</strong> {{ $book->author }}</p>
            <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
            <p><strong>Published Date:</strong> {{ \Carbon\Carbon::parse($book->published_date)->format('Y-m-d') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($book->status) }}</p>

            <div class="mt-4">
                <a href="{{ route('books.edit', $book) }}" class="bg-green-500 text-white px-4 py-2 rounded">Edit</a>
                <a href="{{ route('books.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-4">Back to list</a>

                <!-- Check Out / Return Buttons -->
                @if ($book->status == 'available')
                    <form action="{{ route('books.checkout', $book) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded ml-4">Check Out</button>
                    </form>
                @else
                    <form action="{{ route('books.return', $book) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded ml-4">Return</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
