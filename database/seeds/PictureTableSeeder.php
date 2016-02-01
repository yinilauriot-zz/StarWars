<?php
use App\Picture;
use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PictureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $faker;

    public function __construct(Faker\Generator $faker)
    {
        $this->faker = $faker;
    }

    public function run()
    {
        $files = Storage::allFiles();
        foreach ($files as $file)  Storage::delete($file);

        $products = Product::all();
        foreach ($products as $product)
        {
            $uri = str_random(12).'_370x235.jpg'; 
            Storage::put(
                $uri,
                file_get_contents('http://lorempixel.com/futurama/370/235/')
            );

            Picture::create([
                'product_id' => $product->id,
                'title' => $this->faker->name,
                'uri' => $uri,
            ]);
        }
    }
}
