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
        //$faker = Faker\Factory::create();  // récupérer le Facker opérationnel

        $files = Storage::allFiles(); // retourner un tableau avec tous les noms des images qui se trouvent dans public/uploads
        foreach ($files as $file)  Storage::delete($file);  // parcourir le tableau $files et supprimer toutes les images

        $products = Product::all(); // retourner un tableau avec tous les produits
        foreach ($products as $product)  // parcourir le tableau $products et créer une image par product et l'insérer dans la table pictures
        {
            $uri = str_random(12).'_370x235.jpg';  // str_random(12): générer au hasard une chaine de 12 caractères
            Storage::put(
                $uri,
                file_get_contents('http://lorempixel.com/futurama/370/235/') // file_get_contents: télécharger les images depuis lorempixel.com
            );

            Picture::create([
                'product_id' => $product->id,
                'title' => $this->faker->name,
                //'title' => $faker->name,
                'uri' => $uri,
            ]);
        }
    }
}
