<?php

namespace App\Http\Controllers;

use OpenAI;

use Illuminate\Http\Request;
// use OpenAI\Api;
// use OpenAI\Model\Completion;

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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('paginas.dashboard.home');
    }

    public function openai()
    {
        // $api = new Api("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");
        $client = OpenAI::client("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");

        $result = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => 'create an array in php of ten colors',
        ]);

        dd($result);
    }
}
