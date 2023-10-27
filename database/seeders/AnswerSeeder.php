<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Answer::factory(15)->create()->map(function ($answer) {

            // creating images and files between 1 and 3 randomly
            foreach ([1, 2, 3] as $item) {
                if (rand(0, 1)) {
                    $image = fake()->image(
                        dir: storage_path('app/public'),
                        fullPath: false
                    );

                    $answer->addMedia(storage_path('app/public/') . $image)
                        ->toMediaCollection('images');
                }

                if (rand(0, 1)) {
                    $num = rand(123, 1234);
                    $file = UploadedFile::fake()
                        ->createWithContent("uyIshi-$num.html", "uyIshi-$num")
                        ->storeAs('public', "uyIshi-$num.html");

                    $answer->addMedia(storage_path('app/') . $file)
                        ->toMediaCollection('files');
                }
            }


        });
    }
}
