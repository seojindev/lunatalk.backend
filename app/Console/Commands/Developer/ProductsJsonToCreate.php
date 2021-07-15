<?php

namespace App\Console\Commands\Developer;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if(Storage::disk('inside-temp')->exists($this->jsonFileName))
        {
            $fileContents = Storage::disk('inside-temp')->get($this->jsonFileName);
            $products = (array) json_decode($fileContents, true);

//            print_r($products);
            $bar = $this->output->createProgressBar(count($products));
//            $bar->start();

            foreach ($products as $product):
                $repMediaId = [];
                $detailMediaId = [];

                $images = $product['product_images'];

                $repMediaId = array();
                $detailMediaId = array();

                foreach ($images['rep'] as $element) :
                    $response = Http::withHeaders([
                        'Request-Client-Type' => config('extract.clientType.front.code'),
                        'Accept' => 'application/json'
                    ])->attach(
                        'media_file', file_get_contents($element), basename($element)
                    )->post(env('APP_URL') . '/api/v1/other/media/products/rep/create');

                    if ($response->status() !== 200) {
                        echo $element.PHP_EOL;
                        print_r($response->body());
                        print_r($response->json());
                        exit;
                    }

                    $imageResult = $response->json();
                    $repMediaId[] = $imageResult['result']['media_id'];
                endforeach;

                foreach ($images['detail'] as $element) :

                    $response = Http::withHeaders([
                        'Request-Client-Type' => config('extract.clientType.front.code'),
                        'Accept' => 'application/json'
                    ])->attach(
                        'media_file', file_get_contents($element), basename($element)
                    )->post(env('APP_URL') . '/api/v1/other/media/products/detail/create');

                    if ($response->status() !== 200) {

                        echo $element.PHP_EOL;
                        print_r($response->body());
                        echo PHP_EOL;
                        print_r($response->json());
                        echo PHP_EOL;

//                        print_r(file_get_contents($element));
                        exit;
                    }

                    $imageResult = $response->json();
                    $detailMediaId[] = $imageResult['result']['media_id'];

                endforeach;

//                $response = Http::withHeaders([
//                    'Request-Client-Type' => config('extract.clientType.front.code'),
//                    'Accept' => 'application/json',
//                    'Content-Type' => 'application/json'
//                ])->post(env('APP_URL') . '/api/v1/admin/product/create', [
//                    'product_category' => $product['category'],
//                    'product_name' =>  $product['name'],
//                    'product_option_step1' => $product['option']['step1'],
//                    'product_option_step2' => $product['option']['step2'],
//                    'product_price' => $product['price'],
//                    'product_stock' => $product['stock'],
//                    'product_barcode' => $product['barcode'],
//                    'product_memo' => '메모: ',
//                    'product_sale' => 'Y',
//                    'product_active' => 'N',
//                    'product_image' => $repMediaId,
//                    'product_detail_image' => $detailMediaId
//                ]);

//                $bar->advance();

            endforeach;

//            $bar->finish();
        }





        return 0;
    }
}
