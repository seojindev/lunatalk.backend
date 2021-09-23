<?php

namespace App\Console\Commands\Development;

use App\Models\MediaFileMasters;
use App\Models\ProductCategoryMasters;
use App\Models\ProductImages;
use App\Models\ProductMasters;
use App\Models\ProductOptions;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
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
     * @throws FileNotFoundException
     */
    public function handle(): int
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ProductMasters::truncate();
        ProductOptions::truncate();

        $oldCategory = [
            'P010110' => 'acc',
            'P010120' => 'bag',
            'P010130' => 'stationery',
            'P010140' => 'wallet'
        ];


        if(Storage::disk('inside-temp')->exists('products' . '/' . $this->jsonFileName))
        {
            $fileContents = Storage::disk('inside-temp')->get('products' . '/' . $this->jsonFileName);
            $products = (array) json_decode($fileContents, true);

            $bar = $this->output->createProgressBar(count($products));
            $bar->start();

            foreach ($products as $product):

                $category_id = ProductCategoryMasters::where('name', $oldCategory[$product['category']])->first()->id;

                $pr = ProductMasters::create([
                    'category' => $category_id,
                    'name' => $product['name'],
                    'barcode' => $product['barcode'],
                    'price' => $product['price'],
                    'quantity' => $product['quantity'],
                    'memo' => '',
                    'sale' => 'Y',
                    'active' => 'Y'
                ]);

                if($product['option']['step1']) {
                    ProductOptions::create([
                        'product_id' => $pr->id,
                        'color' => $product['option']['step1']
                    ]);
                }

                if($product['option']['step2']) {
                    ProductOptions::create([
                        'product_id' => $pr->id,
                        'wireless' => $product['option']['step2']
                    ]);
                }

                if(!array_key_exists('rep', $product['product_images'])) {
                    print_r($product);
                }

                foreach ($product['product_images']['rep'] as $element) :

                    $media_id = $this->processImage('rep', $element);

                    ProductImages::create([
                        'product_id' => $pr->id,
                        'media_category' => config('extract.mediaCategory.repImage.code'),
                        'media_id' => $media_id,
                    ]);
                endforeach;

                foreach ($product['product_images']['detail'] as $element) :

                    $media_id = $this->processImage('detail', $element);

                    ProductImages::create([
                        'product_id' => $pr->id,
                        'media_category' => config('extract.mediaCategory.detailImage.code'),
                        'media_id' => $media_id,
                    ]);
                endforeach;

                $bar->advance();
            endforeach;

            $bar->finish();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return 0;
    }

    /**
     * @throws FileNotFoundException
     */
    public function processImage($category, $images) : int
    {
        $thumbWidth = 200;
        $thumbHeight = 200;

        $sourcePath = storage_path('inside/temp/products/images');

        if(isset($images['filename'])) {
            $sourceBaseName = $images['filename'];
        } else {
            print_r($images);
            return 0;
        }

        $randomFilename = Str::random(40);
        $targetFileName = $randomFilename.'.'.pathinfo($sourceBaseName, PATHINFO_EXTENSION);
        $targetThumbFileName = $randomFilename.'_thumb.'.pathinfo($sourceBaseName, PATHINFO_EXTENSION);

        $newSubDir = sha1(date("Ymd"));
        $mediaTargetPath = "storage/products" . '/' . $category . '/' . $newSubDir;

        $fileHeight = $images['height'];
        $fileWidth = $images['width'];
        $fileType = $images['type'];
        $fileSize = $images['size'];
        $fileExtension = $images['extension'];

        $sourceFile = Storage::disk('inside-temp')->get("products/images/" . $sourceBaseName);

        Storage::disk('media-server')->put($mediaTargetPath . '/' . $targetFileName, $sourceFile);

        if($category == 'rep') {
            $taskImage = Image::make($sourcePath . '/' . $sourceBaseName);
            $r = $fileWidth / $fileHeight;
            if ($thumbWidth / $thumbHeight > $r) {
                $newwidth = $thumbHeight * $r;
                $newheight = $thumbHeight;
            } else {
                $newheight = $thumbWidth / $r;
                $newwidth = $thumbHeight;
            }

            $taskImage->resize($newwidth,$newheight);
            $taskImage->save($sourcePath . '/' . $targetThumbFileName);

            $sourceThumbFile = Storage::disk('inside-temp')->get("products/images/" . $targetThumbFileName);
            Storage::disk('media-server')->put($mediaTargetPath . '/' . $targetThumbFileName, $sourcePath . '/' . $sourceThumbFile);
            Storage::disk('inside-temp')->delete("products/images/" . $targetThumbFileName);
        }

        $task = MediaFileMasters::create([
            'media_name' => 'products',
            'media_category' => $category,
            'dest_path' => "/" . $mediaTargetPath,
            'file_name' => $targetFileName,
            'original_name' => $sourceBaseName,
            'width' => $fileWidth,
            'height' => $fileHeight,
            'file_type' => $fileType,
            'file_size' => $fileSize,
            'file_extension' => $fileExtension,
        ]);

        return $task->id;
    }
}
