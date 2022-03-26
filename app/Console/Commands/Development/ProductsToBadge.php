<?php

namespace App\Console\Commands\Development;

use App\Models\ProductBadgeMasters;
use App\Models\ProductBadges;
use App\Models\ProductColorOptionMasters;
use App\Models\ProductMasters;
use App\Models\ProductWirelessOptionMasters;
use DOMDocument;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Intervention\Image\Facades\Image;
use Storage;
use Str;

class ProductsToBadge extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:product-to-badge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '상품 배지 입력.';

    /**
     * @var string
     */
    protected string $spaceName = 'products';

    /**
     * @var string
     */
    protected string $txtFileName = 'products.txt';

    /**
     * @var string
     */
    protected string $jsonFileName = 'products.json';

    /**
     * @var string
     */
    protected string $imagetTargetRoot = '/tmp/lunatalk/images/origin-images';

    /**
     * @var string
     */
    protected string $repNoimage = '';

    /**
     * @var string
     */
    protected string $detailNoimage = '';

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
    public function handle(): int
    {
        $task = ProductBadgeMasters::all();

        $badges = array_map(function($item) {
            return $item['id'];
        } , $task->toArray());

        $task = ProductMasters::all()->toArray();


        $bar = $this->output->createProgressBar(count($task));
        $bar->start();

        foreach ($task as $item) :

            foreach ($badges as $badge) {
                ProductBadges::create([
                    'product_id' => $item['id'],
                    'badge_id' => $badge
                ]);
            }

            $bar->advance();
        endforeach;
        $bar->finish();

        return 0;
    }
}
