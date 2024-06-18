<?php

namespace App\Actions\GoogleMaps;

use Illuminate\Support\Facades\Http;

class Geocode
{
    public static function run(string $endereco)
    {
        $endereco = urlencode($endereco);
        $apiKey = config('services.google.maps.key');
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$endereco}&key={$apiKey}";

        $response = Http::get($url)->object();

        if ($response->status === 'OK') {
            return [
                'latitude' => $response->results[0]->geometry->location->lat,
                'longitude' => $response->results[0]->geometry->location->lng,
                'uf' => collect($response->results[0]->address_components)->firstWhere('types.0', 'administrative_area_level_1')->short_name,
            ];
        }

        return null;
    }
}
