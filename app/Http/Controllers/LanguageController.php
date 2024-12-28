<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function change(Request $request)
    {
        $language = $request->input('language');

        // Set the locale in the application
        App::setLocale($language);

        // Store the locale in the session (optional, but recommended)
        session()->put('locale', $language);

        return response()->json([
            'success' => true,
            'message' => 'Language changed successfully.'
        ]);
    }
}
