<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortUrlRequest;
use App\Models\Url;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

class UrlShortenerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home', [
            'urls' => Url::select('short_url', 'full_url', 'click')->get()
        ]);
    }

    /**
     * Redirect user to a given shorted url
     */
    public function show(?string $url)
    {
        try {
            $url = Url::select('short_url', 'full_url', 'click')
                ->where('short_url', $url)
                ->firstOrFail();

            $url->increment('click');

            return redirect()->away($url->full_url);
        } catch (ModelNotFoundException|QueryException|Exception $e) {
            return back()->withErrors(['error' => 'Failed to short the url']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShortUrlRequest $request)
    {
        try {
            $data = ['short_url' => Str::random(6), 'full_url' => $request->input('url')];
            Url::create($data);

            return back();
        } catch (QueryException|Exception $e) {
            return back()->with(['error' => 'Failed to short url']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($url)
    {
        try {
            Url::where('short_url', $url)->firstOrFail()->delete();

            return back()->with(['success' => 'Shorted url successfully deleted']);
        } catch (ModelNotFoundException|QueryException|Exception $e) {
            return back()->with(['error' => 'Failed to delete shorted url']);
        }
    }
}
