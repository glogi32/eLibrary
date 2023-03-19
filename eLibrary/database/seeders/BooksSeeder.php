<?php

namespace Database\Seeders;

use App\Models\Book;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $bookNumber = time();
        foreach (Range(1,30) as $key => $value) {
            $book = new Book();
            $book->title = $faker->word(25);
            $book->description = $faker->sentence(15);
            $book->book_number = $bookNumber++;
            $book->author_id = rand(1,30);
            $book->created_by_user_id = rand(1,25);

            $book->save();
        }
    }
}
