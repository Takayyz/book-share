<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GenerateService;
use App\Http\Requests;

class IndexController extends Controller
{
    protected $generate;
    public function __cunstruct(GenerateService $generate)
    {
        $this->generate = $generate;
    }

    public function show()
    {
        return view('top');
    }
}
