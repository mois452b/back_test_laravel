<?php

namespace App\Services;

class MarvelAdapter {

    public static function seriesData( $data ) {
        return [
            'id' => $data['id'],
            'type' => $data['mediaType'],
            'title' => $data['title'],
            'description' => $data['description'],
            'path' => $data['thumbnail']['path'],
            'extension' => $data['thumbnail']['extension'],
            'date' => $data['startYear']
        ];
    }
}