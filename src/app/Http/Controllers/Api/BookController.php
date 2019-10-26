<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    const RAKUTEN_API_URL = 'https://app.rakuten.co.jp/services/api/BooksTotal/Search/20170404';

    /**
     * 「キーワード」「ページ数」「ページあたりの表示件数」の情報から本を検索し、jsonを返すAPI
     * 楽天BOOKSAPIを利用。詳しくはgetBooks()参照
     *
     * @param Request $request
     * @return string (json)
     */
    public function index(Request $request): string
    {
        $keyword = $request->input('keyword') ?? '';
        $page    = $request->input('page') ?? '1';
        $hits    = $request->input('hits') ?? '10';

        return $this->getBooks($keyword, $page, $hits);
    }

    /**
     * 1冊の本の情報をISBNコードから特定してjsonで返すAPI
     * 楽天BOOKSAPIを利用。詳細はgetBookDetails()を参照
     *
     * @param string $isbn (route parameter)
     * @return string (json)
     */
    public function showDetails(string $isbn): string
    {
        return $this->getBookDetails($isbn);
    }

    /**
     * 楽天BOOKSAPIを叩いてキーワード検索するメソッド
     *
     * @param string $keyword
     * @param string $page
     * @param string hits
     * @return string (json)
     */
    private function getBooks(string $keyword, string $page, string $hits): string
    {
        $applicationId = config('rakutenApi.APPLICATION_ID');
        if (!empty($keyword)) {
            $url = self::RAKUTEN_API_URL.'?applicationId='.$applicationId.'&keyword='.$keyword.'&hits='.$hits.'&page='.$page;
        } else {
            $url = self::RAKUTEN_API_URL.'?applicationId='.$applicationId.'&booksGenreId=000&hits='.$hits.'&page='.$page;
        }

        $response = @file_get_contents($url);

        if ($response) {
            $data = json_decode($response);

            $books = array_map(function ($book) {
                $item = $book->Item;
                return [
                    'isbn_code' => $item->isbn,
                    'jan_code'  => $item->jan,
                    'title'     => $item->title,
                    'author'    => $item->author,
                    'image_url' => $item->largeImageUrl,
                ];
            }, $data->Items);

            return json_encode([
                'status' => '200',
                'books'  => $books,
            ]);
        } else {
            return json_encode([
                'status' => '400',
                'books'  => [],
            ]);
        }
    }

    /**
     * 楽天BOOKSAPIを叩いてISBNコードから1冊の本の詳細情報を取得するメソッド
     *
     * @param string $isbn
     * @return string (json)
     */
    private function getBookDetails(string $isbn): string
    {
        $applicationId = config('rakutenApi.APPLICATION_ID');
        $url = self::RAKUTEN_API_URL.'?applicationId='.$applicationId.'&isbnjan='.$isbn;

        $response = @file_get_contents($url);

        if ($response) {
            $data = json_decode($response);

            $item = $data->Items[0]->Item;
            $book = [
                'isbn_code' => $item->isbn,
                'jan_code'  => $item->jan,
                'title'     => $item->title,
                'author'    => $item->author,
                'image_url' => $item->largeImageUrl,
            ];

            return json_encode([
                'status' => '200',
                'book'  => $book,
            ]);
        } else {
            return json_encode([
                'status' => '400',
                'book'  => [],
            ]);
        }
    }
}
