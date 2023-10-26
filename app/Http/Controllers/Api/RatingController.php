<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\Comment;
use App\Models\Member;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index()
    {
        //get books
        $books = Book::latest()->paginate(5);

        //return collection of books as a resource
        return new BookResource(true, 'List data Buku', $books);
    }

    /**
     * store
     * 
     * @param mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        // Validasi data rating dari anggota
        $validator = Validator::make($request->all(), [
            'noktp' => 'required',
            'book_id' => 'required',
            'skor_rating' => 'required|integer|min:1|max:5',
            'komentar' => 'max:100'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //cari buku
        $book = Book::find($request->id);

        if (!$book) {
            return response()->json('Buku tidak ditemukan', 404);
        }

        // Dapatkan ID anggota yang telah otentikasi
        $noktp = $request->noktp;
        

        // Periksa apakah pengguna telah memberikan rating sebelumnya
        $existingRating = Rating::where('noktp', $noktp)
            ->where('book_id', $book->id)
            ->first();

        if ($existingRating) {
            return response()->json('Anda telah memberikan rating untuk buku ini sebelumnya', 422);
        }
        // Simpan rating ke dalam tabel Rating dengan mengacu pada buku yang sesuai
        $rating = new Rating([
            'skor_rating' => $request->skor_rating,
            'noktp' => $noktp, 
            'book_id' => $request->$book
        ]);

        // Simpan komentar jika ada
        if ($request->has('komentar')) {
            $comment = new Comment([
                'komentar' => $request->komentar,
                'noktp' => $noktp,
                'book_id' => $request->$book 
            ]);
        }

        $book->ratings()->save($rating);

        if (isset($comment)) {
            $book->comments()->save($comment);
        }
        return new BookResource(true, 'Feedback berhasil ditambahkan', $book);
    }

}
