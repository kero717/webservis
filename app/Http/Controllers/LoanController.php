<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('librarian');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'booking_id' => 'nullable|exists:bookings,id',
        ]);

        $book = Book::findOrFail($validated['book_id']);
        if ($book->available_copies <= 0) {
            return back()->with('error', 'Нет доступных экземпляров');
        }

        if (!empty($validated['booking_id'])) {
            Booking::findOrFail($validated['booking_id'])->delete();
        } else {
            $book->decrement('available_copies');
        }

        Loan::create([
            'user_id' => $validated['user_id'],
            'book_id' => $validated['book_id'],
            'loaned_at' => Carbon::now(),
            'due_at' => Carbon::now()->addDays(14),
        ]);

        return redirect()->route('loans.index')->with('success', 'Книга выдана');
    }

    public function return(Loan $loan)
    {
        if ($loan->returned_at) {
            return back()->with('error', 'Книга уже возвращена');
        }

        $loan->update(['returned_at' => Carbon::now()]);
        $loan->book->increment('available_copies');

        return redirect()->route('loans.index')->with('success', 'Книга принята');
    }

        public function index()
    {
        $loans = Loan::with('user', 'book')->latest()->get();
        return Inertia::render('Loans/Index', [
            'loans' => $loans
        ]);
    }
public function create(Request $request)
{
    $bookings = Booking::with('user', 'book')->where('expires_at', '>', now())->get();
    $books = Book::where('available_copies', '>', 0)->get();
    $users = User::all();
    $selectedBooking = $request->has('booking_id') ? Booking::find($request->booking_id) : null;
    return Inertia::render('Loans/Create', [
        'bookings' => $bookings,
        'books' => $books,
        'users' => $users,
        'selectedBooking' => $selectedBooking,
    ]);
}

}