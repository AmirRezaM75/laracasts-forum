<?php

namespace App\Http\Controllers;

use App\Utilities\Markdown;
use Illuminate\Http\Request;

class MarkdownController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function parse(Request $request)
    {
        return response()->json(Markdown::parse($request->get('markdown')));
    }
}
