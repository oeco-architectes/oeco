<?php

namespace App\Http\Controllers;

use stdClass as Obj;
use Faker\Factory as FakerFactory;
use Illuminate\Http\Request;
use App\DummyImage;

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
            $news[$i] = new Obj();
            $news[$i]->title = $faker->sentence(12, true);
            $news[$i]->headline = $faker->text(120);
            $news[$i]->color = DummyImage::backgroundColorFromIndex($i);
            $news[$i]->image = new DummyImage($width, $height, $news[$i]->color);
        }

        return view('home', [
            'news' => $news
        ]);
    }
}
