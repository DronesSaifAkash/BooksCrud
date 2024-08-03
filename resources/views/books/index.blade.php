<!-- resources/views/books/index.blade.php -->

<x-app-layout>
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Books</h1>

            <!-- Search Form -->
            <form method="GET" action="{{ route('books.index') }}" class="flex items-center space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title or author" class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
                @if(request('search'))
                    <a href="{{ route('books.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Clear Search</a>
                @endif
            </form>

            <a href="{{ route('books.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Book</a>
        </div>

        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead>
                <tr class="w-full bg-gray-100 border-b border-gray-200">
                    <th class="py-2 px-4 text-left">ID</th>
                    <th class="py-2 px-4 text-left">Title</th>
                    <th class="py-2 px-4 text-left">Author</th>
                    <!-- th class="py-2 px-4 text-left">ISBN</>
                    <th class="py-2 px-4 text-left">Published Date</th -->
                    <th class="py-2 px-4 text-left">Status</th>
                    <th class="py-2 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $book->id }}</td>
                        <td class="py-2 px-4 border-b">{{ $book->title }}</td>
                        <td class="py-2 px-4 border-b">{{ $book->author }}</td>
                        <!-- td class="py-2 px-4 border-b">{{ $book->isbn }}</>
                        <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($book->published_date)->format('Y-m-d') }}</td -->
                        <td class="py-2 px-4 border-b">{{ ucfirst($book->status) }}</td>
                        <td class="py-2 px-4 border-b flex space-x-2">
                            <a href="{{ route('books.show', $book) }}" class="text-blue-500">View</a>
                            <a href="{{ route('books.edit', $book) }}" class="text-green-500">Edit</a>

                            <!-- Check Out / Return Buttons -->
                            @if ($book->status == 'available')
                                <form action="{{ route('books.checkout', $book->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-yellow-500">Check Out</button>
                                </form>
                            @else
                                <form action="{{ route('books.return', $book->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-green-500">Return</button>
                                </form>
                            @endif

                            <!-- Delete Form -->
                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-2 px-4 text-center">No books found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
