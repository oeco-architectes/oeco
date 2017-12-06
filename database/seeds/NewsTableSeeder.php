<?php

use Colors\Color;
use CzProject\PathHelper;
use odannyc\GoogleImageSearch\ImageSearch;
use Illuminate\Database\Seeder;
use App\News;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $c = new Color();

        // Let's truncate our existing records to start from scratch.
        News::truncate();

        // Let's delete all news image
        foreach (glob(News::imagePath('*')) as $path) {
            $relativePath = PathHelper::createRelativePath(app_path(), $path);
            echo 'Deleting ' . $c($relativePath)->yellow() . ' ';
            if (unlink($path)) {
                echo $c("✔\n")->green();
            } else {
                echo $c("✘\n")->red();
            }
        }

        // And now, let's create a few records in our database
        $position = 0;
        for ($i = 0; $i < 10; $i++) {
            $news = News::create([
                'title' => $faker->sentence,
                'summary' => $faker->paragraph,
                'position' => $faker->boolean(80) ? $position++ : null
            ]);

            $path = $news->getImagePath();

            if (!file_exists($path)) {
                $relativePath = PathHelper::createRelativePath(app_path(), $path);
                echo 'Generating ' . $c($relativePath)->yellow() . ' ';
                file_put_contents(
                    $path,
                    file_get_contents('http://kitten.amercier.com/kitten.jpg')
                );
                echo $c("✔\n")->green();
            } else {
                echo 'Skipping ' . $path . ', already exists.';
            }
        }
    }
}
