<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        return view('content.dashboard');
    }

    public function explore()
    {
        return view('content.explore');
    }

    public function manage()
    {
        return view('content.manage');
    }

    public function pets()
    {
        return view('content.pets');
    }

    public function history()
    {
        return view('content.history');
    }

    public function account()
    {
        return view('content.account');
    }

    public function about()
    {
        return view('content.about');
    }

    public function accountSettings()
    {
        return view('content.account-settings');
    }

    // Methods to return only the main content without layout
    public function dashboardContent()
    {
        return view('content.dashboard');
    }

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