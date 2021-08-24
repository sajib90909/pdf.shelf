<?php

namespace Database\Seeders\Helpers;

use App\Models\Admin\Book;
use App\Models\Admin\File;
use App\Models\User;
use App\Services\Admin\BookService;
use App\Services\Admin\CommentService;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Faker\Generator;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('books');
        $faker = resolve(Generator::class);

        Book::factory()->times(50)->create()->each(function ($book) use($faker) {
            User::query()->inRandomOrder()->limit(rand(1,26))->get()->each(function ($user) use($book, $faker){
                resolve(BookService::class)
                    ->setModel($user)
                    ->setBook($book)
                    ->setAttrs([
                        'point' => rand (1*10, 5*10) / 10,
                        'category_id' => rand(1,10)
                    ])->saveRating()
                    ->saveView();

                resolve(CommentService::class)
                    ->setModel($user)
                    ->setBook($book)
                    ->setAttr('text',$faker->text(rand(20,50)))
                    ->saveComments();

                if (rand(0,1) == 1){
                    resolve(BookService::class)
                        ->setModel($user)
                        ->setBook($book)
                        ->saveFavourite();
                }
            });

            $book->attachments()->create([
                'type' => 'image',
                'name' => 'image',
                'path' => 'images/book/'.$faker->image('public/images/book',640,480, null, false)
            ]);
        });

    }
}
