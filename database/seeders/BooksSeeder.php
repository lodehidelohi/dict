<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Books;
use Faker\Factory as Faker;

class BooksSeeder extends Seeder
{
    public function run(): void
    {
         Books::factory(50)->create();
        }
    }
