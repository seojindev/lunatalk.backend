<?php

namespace App\Console\Commands\Development;

use App\Models\ProductCategories;
use App\Models\ProductColorOptions;
use App\Models\ProductMasters;
use App\Models\ProductOptionMasters;
use App\Models\ProductWirelessOptions;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Storage;

class ProductsJsonToCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:product-create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'json 파일 데이터 입력.';

    /**
     * @var string
     */
    protected string $spaceName = 'products';

    /**
     * @var string
     */
    protected string $jsonFileName = 'products.json';

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

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ProductMasters::truncate();
        ProductOptionMasters::truncate();

        $oldCategory = [
            'P010110' => 'acc',
            'P010120' => 'bag',
            'P010130' => 'stationery',
            'P010140' => 'wallet'
        ];


        if(Storage::disk('inside-temp')->exists($this->jsonFileName))
        {
            $fileContents = Storage::disk('inside-temp')->get($this->jsonFileName);
            $products = (array) json_decode($fileContents, true);

            $bar = $this->output->createProgressBar(count($products));
            $bar->start();

            foreach ($products as $product):

                $category_id = ProductCategories::where('name', $oldCategory[$product['category']])->first()->id;

                $pr = ProductMasters::create([
                    'category' => $category_id,
                    'name' => $product['name'],
                    'barcode' => $product['barcode'],
                    'price' => $product['price'],
                    'stock' => $product['stock'],
                    'memo' => '',
                    'sale' => 'Y',
                    'active' => 'Y'
                ]);

                if($product['option']['step1']) {
                    ProductOptionMasters::create([
                        'product_id' => $pr->id,
                        'color' => $product['option']['step1']
                    ]);
                }

                if($product['option']['step2']) {
                    ProductOptionMasters::create([
                        'product_id' => $pr->id,
                        'wireless' => $product['option']['step2']
                    ]);
                }

                $bar->advance();
            endforeach;

            $bar->finish();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return 0;
    }
}
