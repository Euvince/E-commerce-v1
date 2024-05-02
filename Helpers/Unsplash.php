<?php 

namespace Helpers;

class Unsplash
{
    private $api_key;

    public function __construct($api_key)
    {
        $this->api_key = $api_key;
    }

    public static function getUrlPictures(string $query): ?string
    {
        $curl = curl_init("https://api.unsplash.com/photos/random?query={$query}&client_id=um4ox2vMwBA5lMimLj2-TxNrD73blAkEkGv5nwo2nxs");
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
        ]);

        $data = curl_exec($curl);
        if($data === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200)
        {
            return null;
        }
        $data = json_decode($data, true);
        return $data['urls']['regular'];
    }
}