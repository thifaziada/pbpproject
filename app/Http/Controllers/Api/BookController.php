<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use App\Http\Resources\BookResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
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
     * show
     *
     * @param  mixed $book
     * @return void
     */
    public function show(Book $book)
    {
    {
        // Mengambil buku berserta rating dan komentar terkait
        $booksrating = $book->with('ratings', 'comments')->first();

        if (!$booksrating) {
            return response()->json(['message' => 'Data Buku tidak ditemukan'], 404);
        }

        return new BookResource(true, 'Data Buku ditemukan!', $booksrating);
    }

        // //return single book as a resource
        // return new BookResource(true, 'Data Buku ditemukan!', $book);
    }


    /**
     * store
     * 
     * @param mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'idbuku' => 'required',
            'isbn' => 'required',
            'judul' =>  'required',
            'idkategori' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'kota_terbit' => 'required',
            'editor' => 'required',
            'file_gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stok' => 'required',
            'stok_tersedia' => 'required'
        ]);
        //check if validation fails
        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
 
        //upload image
        $file_gambar = $request->file('file_gambar');
        $file_gambar->storeAs('public/books', $file_gambar->hashName());

        //create book
        $book = Book::create([
            'idbuku' => $request->idbuku,
            'isbn' => $request->isbn,
            'judul' =>  $request->judul,
            'idkategori' => $request->idkategori,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'kota_terbit' => $request->kota_terbit,
            'editor' => $request->editor,
            'file_gambar' => $file_gambar->hashName(),
            'stok' => $request->stok,
            'stok_tersedia' => $request->stok_tersedia
        ]);

        //return response
        return new BookResource(true, 'Data Buku Berhasil Ditambahkan!', $book);
    } 
}
