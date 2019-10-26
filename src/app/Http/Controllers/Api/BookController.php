<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    //
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $page    = $request->input('page');
        $hits    = $request->input('hits');

        $url = 'https://app.rakuten.co.jp/services/api/BooksTotal/Search/20170404?applicationId=1019399324990976605&keyword='.$keyword.'&hits='.$hits.'&page='.$page;

        $data = json_decode(file_get_contents($url));

        $books = array_map(function ($book) {
            $item = $book->Item;
            return [
                'isbn_code' => $item->isbn,
                'title'     => $item->title,
                'author'    => $item->author,
                'image_url' => $item->largeImageUrl,
            ];
        }, $data->Items);

        return response()->json($books);
    }
}
