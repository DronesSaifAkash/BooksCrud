<?php

// tests/Feature/BookCheckoutTest.php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;

class BookCheckoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_checkout_a_book()
    {
        $book = Book::factory()->create([
            'status' => 'available',
        ]);

        $response = $this->patchJson("/api/books/{$book->id}/checkout");

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'status' => 'checked_out',
                 ]);

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'status' => 'checked_out',
        ]);
    }
}
