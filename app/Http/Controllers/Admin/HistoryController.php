<?php

namespace App\Http\Controllers\Admin;

use App\History;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = History::with('product', 'customer')->orderBy('command_at', 'desc')->paginate(20);

        $title = "History";

        return view('admin.history', compact('histories', 'title'));
    }
}
