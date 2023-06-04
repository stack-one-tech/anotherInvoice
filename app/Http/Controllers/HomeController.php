<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function createInvoice()
    {
        return view('create_invoice');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function previewInvoice()
    {
        $pdfPath = storage_path('app/preview.pdf');
        $headers = [
            'Content-Type' => 'application/pdf',
        ];
        return response()->file($pdfPath, $headers);
    }

    /**
     * @return View
     */
    public function settings()
    {
        return view('settings');
    }
}
