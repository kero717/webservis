<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('client')->except(['index', 'store', 'destroy']);
    }
    public function store(Request $request, Book $book)
    {
        if ($book->available_copies <= 0) {
            return back()->with('error', 'Книга недоступна для бронирования');
        }

        $existing = Auth::user()->bookings()->where('book_id', $book->id)->first();
        if ($existing) {
            return back()->with('error', 'Вы уже забронировали эту книгу');
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'expires_at' => Carbon::now()->addDays(3),
        ]);

        $book->decrement('available_copies');

        return redirect()->route('bookings.index')->with('success', 'Книга забронирована до ' . $booking->expires_at->format('d.m.Y H:i'));
    }

    public function destroy(Booking $booking)
    {
        if ($booking->user_id != Auth::id()) {
            abort(403);
        }

        $booking->book->increment('available_copies');
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Бронь снята');
    }
    public function index()
    {
        $bookings = auth()->user()->bookings()->with('book')->latest()->get();
        return Inertia::render('Bookings/Index', ['bookings' => $bookings]);
    }
    public function allBookings()
{
    $bookings = Booking::with('user', 'book')->latest()->get();
    return Inertia::render('Admin/Bookings', [
        'bookings' => $bookings
    ]);
}
}