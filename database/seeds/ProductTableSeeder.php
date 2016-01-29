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

    // injection de dépendance
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function run()
    {
        // fonction anonyme
        $shuffle = function($tags, $num)
        {
            $s=[];
            shuffle($tags); // mixer le tableau
            while ($num >= 0)
            {
                $s[] = $tags[$num];
                $num--;
            }
            return $s;
        };

        $max = $this->tag->count();  // $max=Tag::count() si sans __construct
        $tags = $this->tag->lists('id')->toArray(); // list('id'): retourner un objet avec une liste des id de tags; toArray(): passer une collection à un tableau; $tags=Tag::lists('id') si sans __construct

        //                                              fonction anonyme    pour utiliser les variables dehors de la fonction anonyme, il faut faire use($variable)
        factory(App\Product::class, 15)->create()->each(function($product) use($max, $tags, $shuffle)  // 15: nombre de produits
        {
            //var_dump($product); // récupérer chaque entité avec un product créé dans la table products, une ligne de la table = un objet

            $product->tags()->attach($shuffle($tags, rand(1, $max-1)));
        });
    }
}
