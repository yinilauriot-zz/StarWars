<?php

use App\Tag;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function run()
    {
        $shuffle = function($tags, $num) {
            $s=[];
            shuffle($tags);
            while ($num >= 0) {
                $s[] = $tags[$num];
                $num--;
            }
            return $s;
        };

        $max = $this->tag->count();
        $tags = $this->tag->lists('id')->toArray();

        factory(App\Product::class, 15)->create()->each(function($product) use($max, $tags, $shuffle)  // 15: nombre de produits
        {
             $product->tags()->attach($shuffle($tags, rand(1, $max-1)));
        });
    }
}
