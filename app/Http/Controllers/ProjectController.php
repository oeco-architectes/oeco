<?php

namespace App\Http\Controllers;

use stdClass as Obj;
use Faker\Factory as FakerFactory;
use Illuminate\Http\Request;
use RectangularMozaic\Cell;
use RectangularMozaic\Generator as Mozaic;
use App\DummyImage;

class ProjectController extends Controller
{
    /**
     * Show all projects
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $faker = FakerFactory::create();

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
            $projects[$i]->title = $faker->sentence(8, true);
            $projects[$i]->color = DummyImage::backgroundColorFromIndex($i);
            $projects[$i]->image = new DummyImage(960, 540, $projects[$i]->color);
        }

        $grid = Mozaic::generate(count($projects), config('ui.mozaic.columns'));
        $i = 0;
        $tileTypes = [
            Cell::SMALL => 'small',
            Cell::TALL_TOP => 'tall',
            Cell::WIDE_RIGHT => 'wide',
        ];
        foreach ($grid->getCells() as $row) {
            foreach ($row as $cell) {
                if (array_key_exists($cell, $tileTypes)) {
                    $projects[$i]->tileType = $tileTypes[$cell];
                    $i += 1;
                }
            }
        }

        return view('projects.index', [
            'categories' => $categories,
            'projects' => $projects,
        ]);
    }

    /**
     * Show a project's contents
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $faker = FakerFactory::create();

        $project = new Obj();
        $project->title = $faker->sentence(8, true);
        $sections = [];
        for ($i = 0; $i < 20; $i++) {
            if ($i % 2 === 0) {
                $sections[$i] = $faker->paragraphs(3, true);
            } else {
                $sections[$i] = new Obj();
                $sections[$i]->color = DummyImage::backgroundColorFromIndex(floor($i / 2));
                $sections[$i]->image = new DummyImage(960, 540, $sections[$i]->color);
                $sections[$i]->title = $project->title . ' #' . ceil($i / 2);
            }
        }

        return view('projects/show', [
            'project' => $project,
            'sections' => $sections,
        ]);
    }
}
