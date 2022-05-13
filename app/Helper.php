<?php

use Illuminate\Support\Facades\URL;

function access_token($code) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data['grant_type'] = 'authorization_code';
    $data['code'] = $code;
    $data['redirect_uri'] = env("SPOTIFY_CALLBACK_URL");
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $headers = array();
    $headers[] = 'Authorization: Basic ' . base64_encode(env("SPOTIFY_CLIENT_ID") . ':' . env("SPOTIFY_CLIENT_SECRET"));
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    $json_decode = json_decode($result);
    return array($json_decode->access_token, $json_decode->refresh_token);
}

function refresh_token($code) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data['grant_type'] = 'refresh_token';
    $data['refresh_token'] = $code;
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $headers = array();
    $headers[] = 'Authorization: Basic ' . base64_encode('44ca9e1f6e504fb0a7cd5ec6c8882878:b24fce5bb0b04076939dfb926de78a1d');
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    $json_decode = json_decode($result);
    return $json_decode->access_token;
}

function search_api($search_q, $type = 'album') {
    $ch = curl_init();    
    curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/search?type=' . $type . '&q=' . $search_q);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

    $headers = array();
    $headers[] = 'Authorization: Bearer ' . env("SPOTIFY_ACCESS_TOKEN");
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    return json_decode($result);
}
