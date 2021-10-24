<?php

namespace App\Console\Commands\Development;

use App\Models\ProductMasters;
use Illuminate\Console\Command;

class InsertOriginalPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:product-original-price-insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '원래 금액 입력.';

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
        $priceArray = [5000, 6000, 7000, 8000];
        $products = ProductMasters::where('id', '>', 0)->get()->toArray();

        foreach ($products as $product) {

            shuffle($priceArray);
            ProductMasters::where('id', $product['id'])->update([
                'original_price' => $product['price'] + $priceArray[0]
            ]);
        }

        return 0;
    }
}
