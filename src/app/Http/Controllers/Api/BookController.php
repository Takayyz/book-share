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

        return $this->getBooks($keyword, $page, $hits);
    }

    public function showDetails($isbn)
    {
        return $this->getBookDetails($isbn);
    }

    private function getBooks($keyword, $page, $hits)
    {
        $applicationId = config('rakutenApi.APPLICATION_ID');
        $url = self::RAKUTEN_API_URL.'?applicationId='.$applicationId.'&keyword='.$keyword.'&hits='.$hits.'&page='.$page;

        $response = @file_get_contents($url);

        if ($response) {
            $data = json_decode($response);
            $books = array_map(function ($book) {
                $item = $book->Item;
                return [
                    'isbn_code' => $item->isbn,
                    'title'     => $item->title,
                    'author'    => $item->author,
                    'image_url' => $item->largeImageUrl,
                ];
            }, $data->Items);

            return [
                'status' => '200',
                'books'  => $books,
            ];
        } else {
            return [
                'status' => '400',
                'books'  => [],
            ];
        }
    }

    private function getBookDetails($isbn)
    {
        $applicationId = config('rakutenApi.APPLICATION_ID');
        $url = self::RAKUTEN_API_URL.'?applicationId='.$applicationId.'&isbnjan='.$isbn;

        $response = @file_get_contents($url);

        if ($response) {
            $data = json_decode($response);

            $item = $data->Items[0]->Item;
            $book = [
                'isbn_code' => $item->isbn,
                'title'     => $item->title,
                'author'    => $item->author,
                'image_url' => $item->largeImageUrl,
            ];

            return [
                'status' => '200',
                'book'  => $book,
            ];
        } else {
            return [
                'status' => '400',
                'book'  => [],
            ];
        }
    }
}
