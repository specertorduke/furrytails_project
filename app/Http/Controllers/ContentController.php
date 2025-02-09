<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentController extends Controller
{
    // Methods to return only the main content without layout
    public function exploreContent()
    {
        return view('content.explore');
    }

    public function manageContent()
    {
        return view('content.manage');
    }

    public function petsContent()
    {
        return view('content.pets');
    }

    public function historyContent()
    {
        return view('content.history');
    }

    public function accountContent()
    {
        return view('content.account');
    }

    public function aboutContent()
    {
        return view('content.about');
    }
}