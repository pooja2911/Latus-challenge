<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller {

    public function index() {
        return view('index');
    }

    public function search(Request $request) {
        $query = $request->get('query');
        session(['search_query' => $query]);
        if (env('SPOTIFY_ACCESS_TOKEN') == '') {
            return redirect('https://accounts.spotify.com/authorize?response_type=code&client_id=' . env("SPOTIFY_CLIENT_ID") . '&redirect_uri=' . env("SPOTIFY_CALLBACK_URL"));
        } else {
            return $this->get_search($query);
        }
    }

    public function callback(Request $request) {
        $access_token = access_token($request->code);
        $path = base_path('.env');
        /* add refresh token */
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                            'SPOTIFY_ACCESS_TOKEN=' . env('SPOTIFY_ACCESS_TOKEN'), 'SPOTIFY_ACCESS_TOKEN=' . $access_token[0], file_get_contents($path)
            ));
            file_put_contents($path, str_replace(
                            'SPOTIFY_REFRESH_TOKEN=' . env('SPOTIFY_REFRESH_TOKEN'), 'SPOTIFY_REFRESH_TOKEN=' . $access_token[1], file_get_contents($path)
            ));
        }
        /* add refresh token */
        return redirect('/');
        /* search from spotify */
//        return $this->get_search($search_q);
    }

    function get_search($search_q) {
        $data['searchTerm'] = $search_q;
        $data['album'] = search_api($search_q, 'album');
        $data['artist'] = search_api($search_q, 'artist');
        $data['track'] = search_api($search_q, 'track');
        return view('search', $data);
        /* search from spotify */
    }

}
