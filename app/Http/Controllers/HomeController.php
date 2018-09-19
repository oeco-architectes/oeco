<?php

namespace App\Http\Controllers;

use stdClass as Obj;
use Faker\Factory as FakerFactory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the home page
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $faker = FakerFactory::create();
        $width = 960;
        $height = 540;
        $backgrounds = [
            '4caf50', 'd81b60', 'f57c00', '03a9f4', '673ab7', '009688', 'f44336'
        ];

        $news = [];
        for ($i = 0; $i < 20; $i++) {
            $color = $backgrounds[$i % count($backgrounds)];

            $news[$i] = new Obj();
            $news[$i]->title = $faker->sentence(12, true);
            $news[$i]->headline = $faker->text(120);
            $news[$i]->image = new Obj();
            $news[$i]->image->href = 'https://dummyimage.com/' . $width . 'x' . $height . '/' . $color . '/fff';
            $news[$i]->image->width = $width;
            $news[$i]->image->height = $height;
            $news[$i]->image->color = $color;
        }

        return view('home', [
            'news' => $news
        ]);
    }
}
