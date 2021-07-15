<?php

namespace App\Console\Commands\Developer;

use App\Models\ProductImages;
use App\Models\ProductOptions;
use App\Models\Products;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Helper;
use function App\Models\ProductImages;
use function App\Models\ProductOptions;

class ProductsJsonToCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:json-to-create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'json 파일 데이터 입력.';

    protected $spaceName = 'products';
    protected $jsonFileName = 'products.json';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return int
     * @throws FileNotFoundException
     */
    public function handle()
    {
        if(Storage::disk('inside-temp')->exists($this->jsonFileName))
        {
            $fileContents = Storage::disk('inside-temp')->get($this->jsonFileName);
            $products = (array) json_decode($fileContents, true);

            $bar = $this->output->createProgressBar(count($products));
            $bar->start();

            foreach ($products as $product):

                $createTask = Products::create([
                    'uuid' => Helper::randomNumberUUID(),
                    'category' => $product['category'],
                    'name' => $product['name'],
                    'barcode' => $product['barcode'],
                    'price' => $product['price'],
                    'stock' => $product['stock'],
                    'memo' => '',
                    'sale' => 'Y',
                    'active' => 'Y'
                ]);

                ProductOptions::create([
                    'product_id' => $createTask->id,
                    'step1' => $product['option']['step1'],
                    'step2' => $product['option']['step2']
                ]);

                if(!array_key_exists('rep', $product['product_images'])) {
                    print_r($product);
                }

                foreach ($product['product_images']['rep'] as $element) :
                    ProductImages::create([
                        'product_id' => $createTask->id,
                        'media_category' => "G010010",
                        'media_id' => $element,
                    ]);
                endforeach;

                foreach ($product['product_images']['detail'] as $element) :
                    ProductImages::create([
                        'product_id' => $createTask->id,
                        'media_category' => "G010020",
                        'media_id' => $element,
                    ]);
                endforeach;

                $bar->advance();
            endforeach;

            $bar->finish();
        }

        return 0;
    }
}
