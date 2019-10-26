<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    const RAKUTEN_API_URL = 'https://app.rakuten.co.jp/services/api/BooksTotal/Search/20170404';

    //
    public function index(Request $request)
    {
        $keyword = $request->input('keyword') ?? '';
        $page    = $request->input('page') ?? 1;
        $hits    = $request->input('hits') ?? 1;

        if (!empty($keyword)) {
            return response()->json([
                'status' => '200',
                'books'  => $books,
            ]);
        } else {
            return response()->json([
                'status' => '400',
                'books'  => [],
            ]);
        }
    }

    private function getBooks($keyword, $page, $hits)
    {
        $applicationId = config('rakutenApi.APPLICATION_ID');
        $url = self::RAKUTEN_API_URL.'?applicationId='.$applicationId.'&keyword='.$keyword.'&hits='.$hits.'&page='.$page;

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

        return $books;
    }
}
