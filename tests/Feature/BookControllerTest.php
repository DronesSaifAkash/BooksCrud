<?php

// tests/Feature/BookControllerTest.php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_book()
    {
        $response = $this->postJson('/api/books', [
            'title' => 'New Book',
            'author' => 'Author Name',
            'isbn' => '1234567890123',
            'published_date' => '2024-01-01',
            'status' => 'available',
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'title' => 'New Book',
                     'author' => 'Author Name',
                     'isbn' => '1234567890123',
                     'published_date' => '2024-01-01',
                     'status' => 'available',
                 ]);

        $this->assertDatabaseHas('books', [
            'title' => 'New Book',
            'author' => 'Author Name',
            'isbn' => '1234567890123',
            'published_date' => '2024-01-01',
            'status' => 'available',
        ]);
    }
}
