<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct()
    {
        // Доступ к созданию, редактированию и удалению только у библиотекарей и админов
        $this->middleware('auth');
        $this->middleware('librarian')->except(['index', 'show']);
    }

    public function index(Request $request)
{
    $query = Book::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('author', 'like', "%{$search}%")
              ->orWhere('genre', 'like', "%{$search}%")
              ->orWhere('publisher', 'like', "%{$search}%");
        });
    }

    $books = $query->get();
    return view('books.index', compact('books'));
}

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'nullable|string|max:100',
            'publisher' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1800|max:' . date('Y'),
            'isbn' => 'nullable|string|max:20',
            'copies' => 'required|integer|min:1',
        ]);

        // При создании available_copies = copies
        $validated['available_copies'] = $validated['copies'];

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Книга успешно добавлена');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'nullable|string|max:100',
            'publisher' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1800|max:' . date('Y'),
            'isbn' => 'nullable|string|max:20',
            'copies' => 'required|integer|min:1',
        ]);

        // Корректируем available_copies при изменении общего количества
        $oldCopies = $book->copies;
        $oldAvailable = $book->available_copies;
        $newCopies = $validated['copies'];
        // Если общее количество увеличилось, добавляем разницу к доступным
        // Если уменьшилось, уменьшаем доступные (но не ниже 0)
        $delta = $newCopies - $oldCopies;
        $validated['available_copies'] = max(0, $oldAvailable + $delta);

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Книга обновлена');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Книга удалена');
    }
}