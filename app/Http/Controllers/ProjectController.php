<?php

namespace App\Http\Controllers;

use stdClass as Obj;
use Faker\Factory as FakerFactory;
use Illuminate\Http\Request;
use RectangularMozaic\Generator as Mozaic;
use RectangularMozaic\Tile;
use App\DummyImage;

class ProjectController extends Controller
{
    protected static function getImage($project, string $breakpoint, Tile $tile)
    {
        $width = config("ui.mozaic.{$breakpoint}.width");
        $height = config("ui.mozaic.{$breakpoint}.height");
        $gap = config("ui.mozaic.{$breakpoint}.gap");

        switch ($tile->getValue()) {
            case Tile::SMALL:
                return new DummyImage($width, $height, $project->color);
            case Tile::TALL:
                return new DummyImage($width, 2 * $height + $gap, $project->color);
            case Tile::WIDE:
                return new DummyImage(2 * $width + $gap, $height, $project->color);
        }
    }

    protected static function getResponsiveQuery(string $breakpoint)
    {
        $ems = intval(config("ui.breakpoints.{$breakpoint}")) / 16;
        return "min-width: {$ems}em";
    }

    protected static function getResponsiveImages($project, Tile $tile)
    {
        return array_map(function ($breakpoint) use ($project, $tile) {
            return [
                static::getImage($project, $breakpoint, $tile),
                static::getResponsiveQuery($breakpoint),
            ];
        }, ['wide', 'desktop']);
    }

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
        $grid = Mozaic::generate(30, config('ui.mozaic.columns'));
        foreach ($grid->getTiles(true, true) as $i => $tile) {
            $projects[$i] = new Obj();
            $projects[$i]->category = $categories[ $i % count($categories) ];
            $projects[$i]->title = $faker->sentence(8, true);
            $projects[$i]->color = DummyImage::backgroundColorFromIndex($i);
            $projects[$i]->tileType = strtolower("{$tile}");
            $projects[$i]->image = new DummyImage(960, 540, $projects[$i]->color);
            $projects[$i]->responsiveImages = static::getResponsiveImages($projects[$i], $tile);
            $projects[$i]->wideImage = static::getImage($projects[$i], 'wide', $tile);
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
