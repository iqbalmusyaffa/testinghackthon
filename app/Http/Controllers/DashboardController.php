<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Pass the posts data to the dashboard view
        return view('dashboard');
    }
}
