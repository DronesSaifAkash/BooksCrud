Laravel Coding Test
Task Overview

You are required to build a simple web application for managing a list of books. The application should include basic CRUD (Create, Read, Update, Delete) operations for books, user authentication, and some additional functionalities.

Requirements

1. Database Schema

    - Create a database schema for a `books` table with the following fields:
        - `id`: Primary key, auto-increment.
        - `title`: String, required.
        - `author`: String, required.
        - `isbn`: String, unique.
        - `published_date`: Date.
        - `status`: Enum (`available`, `checked_out`).

2. User Authentication

    - Implement user registration and login functionalities using Laravel's built-in authentication scaffolding.
    - Only authenticated users should be able to access the book management functionalities.

3. Book Management

    - Implement CRUD operations for the books.
    - List all books with pagination. The list should show the title, author, and status.
    - Include a search functionality to filter books by title or author.
    - Only authenticated users should be able to create, update, or delete books.

4. Additional Functionalities

    - Implement a feature that allows users to check out and return books.
        - When a book is checked out, its status should change to `checked_out`.
        - When a book is returned, its status should change back to `available`.

5. API Endpoints

    - Implement RESTful API endpoints for the following:
        - Fetch all books (`GET /api/books`)
        - Fetch a single book (`GET /api/books/{id}`)
        - Create a new book (`POST /api/books`)
        - Update a book (`PUT /api/books/{id}`)
        - Delete a book (`DELETE /api/books/{id}`)
        - Check out a book (`POST /api/books/{id}/checkout`)
        - Return a book (`POST /api/books/{id}/return`)
    - Ensure proper validation and error handling in the API.

6. Front-End Integration

    - Use Blade templates to create a simple front-end for the application.
    - The front-end should provide an interface for all the functionalities mentioned above.

7. Testing
    - Write unit tests for at least two functionalities in your application.
    - Write API tests for all API endpoints.

These features ensure that only authenticated users can manage books, including creating new ones and modifying their status based on the check-out and return actions.

---------------------------------------------------------------------------------------------------

Steps To Run the Laravel Project
Here are the simple steps to run the Laravel project based on the instructions:

1. Clone or Download the Project

    - If the project is hosted on a repository (like GitHub), clone it using:

        git clone <repository-url>

    - Alternatively, download the project files to your local machine.

2. Navigate to the Project Directory

    - Open your terminal and navigate to the project's root directory:

        cd /path/to/your-project

3. Install Dependencies

    - Make sure you have Composer installed. Run the following command to install all the required dependencies:

        composer install
        npm install

4. Set Up the Environment File

    - Copy the `.env.example` file to create a new `.env` file:

        cp .env.example .env

    - Open the `.env` file and update the database connection details to match your local setup (MySQL or SQLite).

5. Generate an Application Key

    - Generate a new application key by running:

        php artisan key:generate

6. Run Database Migrations

    - To set up the database schema, run the migrations:

        php artisan migrate

7. Run the Development Server

    - Start the Laravel development server by running:

        php artisan serve

8. Access the Application

    - Open your web browser and go to:

        http://127.0.0.1:8000

    - This will launch the application, allowing you to interact with it via the browser.

9. Optional: Run Tests

    - If you want to run the unit and API tests, use the following command:

        php artisan test

10. Usage of Web Interface and API Endpoints:

    Web Interface

    -   List Books: ` http://127.0.0.1:8000/books`
    -   Search Books: `http://127.0.0.1:8000/books?search=query`
    -   Create Book: `http://127.0.0.1:8000/books/create`
    -   Edit Book: `http://127.0.0.1:8000/books/{id}/edit`
    -   View Book: `http://127.0.0.1:8000/books/{id}`
    -   Delete Book: `http://127.0.0.1:8000/books/{id}`

    API Endpoints

    -   Get All Books: `GET  http://127.0.0.1:8000/api/books `
    -   Get Single Book: `GET  http://127.0.0.1:8000/api/books/{id} `
    -   Create Book: `POST  http://127.0.0.1:8000/api/books `
    -   Update Book: `PUT  http://127.0.0.1:8000/api/books/{id} `
    -   Delete Book: `DELETE http://127.0.0.1:8000/api/books/{id} `
    -   Checkout Book: `PATCH http://127.0.0.1:8000/api/books/{id}/checkout `
    -   Return Book: `PATCH http://127.0.0.1:8000/api/books/{id}/return `
