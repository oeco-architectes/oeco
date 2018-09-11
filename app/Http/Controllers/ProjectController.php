<?php

namespace App\Http\Controllers;

use stdClass as Obj;
use Faker\Factory as FakerFactory;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Show all projects
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

        $categories = [];
        for ($i = 0; $i < 6; $i++) {
            $categories[$i] = new Obj();
            $categories[$i]->id = $faker->word();
            $categories[$i]->name = ucfirst($categories[$i]->id);
        }

        $projects = [];
        for ($i = 0; $i < 30; $i++) {
            $projects[$i] = new Obj();
            $projects[$i]->category = $categories[ $i % count($categories) ];
            $projects[$i]->title = $faker->sentence(12, true);
            $projects[$i]->image = new Obj();
            $projects[$i]->image->href =
                'https://dummyimage.com/'
                . $width . 'x' . $height . '/'
                . $backgrounds[$i % count($backgrounds)] . '/fff';
            $projects[$i]->image->width = $width;
            $projects[$i]->image->height = $height;
        }

        return view('projects.index', [
            'categories' => $categories,
            'projects' => $projects
        ]);
    }
}
