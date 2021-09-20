<?php

namespace App\Console\Commands\Development;

use App\Models\MediaFileMasters;
use App\Models\ProductColorOptionMasters;
use App\Models\ProductWirelessOptionMasters;
use Http;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Storage;
use Str;

class ProductsTxtToJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:product-create-json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '상품 txt 파일을 json 으로 변경.';

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
     * @throws FileNotFoundException
     */
    public function handle(): int
    {
        if(Storage::disk('inside-space')->exists($this->spaceName . '/' . $this->txtFileName))
        {
            $fileContents = Storage::disk('inside-space')->get($this->spaceName . '/' . $this->txtFileName);

            if (!file_exists($this->imagetTargetRoot)) {
                mkdir($this->imagetTargetRoot, 0777, true);
            }

            $noImageUrl = "http://img.echosting.cafe24.com/thumb/img_product_big.gif";
            $targetBaseName = Str::random(40).'.gif';
            $this->repNoimage = $this->getProductImage('rep', 'true', $noImageUrl, $targetBaseName);
            $this->detailNoimage = $this->getProductImage('detail', 'false', $noImageUrl, $targetBaseName);

            $bar = $this->output->createProgressBar(count(array_filter(explode("\n", $fileContents), fn($value) => !is_null($value) && $value !== '')));
            $bar->start();

            $products = array_map(function($element) use($bar) {
                $arrayStep1 = explode("," , $element);

                $optionStep1 = ProductColorOptionMasters::select()->where('name', trim($arrayStep1[2]))->first();

                if(trim($arrayStep1[3])) {
                    $wire = trim($arrayStep1[3]) == '무선' ? 'Y' : 'N';
                    $optionStep2 = ProductWirelessOptionMasters::select()->where('wireless', $wire)->first();
                } else {
                    $optionStep2 = NULL;
                }


                $product_url = trim($arrayStep1[7]);
                $images = [];

                $pattern = '/\bhttp\b/';

                if (preg_match($pattern, $product_url)) {
                    $htmlString = file_get_contents($product_url);
                    $htmlDom = new \DOMDocument();
                    @$htmlDom->loadHTML($htmlString);
                    $imageTags = $htmlDom->getElementsByTagName('img');
                    $extractedImages = array();

                    foreach($imageTags as $imageTag){
                        $imgSrc = $imageTag->getAttribute('src');
                        $altText = $imageTag->getAttribute('alt');
                        $titleText = $imageTag->getAttribute('title');
                        $classText = $imageTag->getAttribute('class');

                        $extractedImages[] = array(
                            'src' => $imgSrc,
                            'alt' => $altText,
                            'title' => $titleText,
                            'classText' => $classText
                        );
                    }

                    // 대표 이미지
                    $bigimages = array_values(array_map(function($element) {
                        return 'http:' . $element['src'];

                    }, array_filter($extractedImages, fn($value) => (trim($value['classText']) == 'BigImage' && trim($value['src']) !== '//img.echosting.cafe24.com/thumb/img_product_big.gif'))));

                    // 대표 썸네일 이미지
                    $thumbimage = array_values(array_map(function($element) {

                        return str_replace("/small/", "/big/", 'http:' . $element['src']);

                    }, array_filter($extractedImages, fn($value) => (trim($value['classText']) == 'ThumbImage' && trim($value['src']) !== '//img.echosting.cafe24.com/thumb/img_product_small.gif'))));

                    $product_image = array_merge_recursive($bigimages,$thumbimage);

                    // detimg 상세 이미지
                    $detailTmpImages1 = array_values(array_map(function($element) {
                        return 'http://lunatalk.co.kr' . $element['src'];
                    }, array_filter($extractedImages, fn($value) => (strpos($value['src'], '/detimg') !== false))));

                    $detailTmpImages2 = array_values(array_map(function($element) {
                        return 'http://lunatalk.co.kr' . $element['src'];
                    }, array_filter($extractedImages, fn($value) => (strpos($value['src'], '/ACC/') !== false))));
                    $detailTmpImages2 = array_unique($detailTmpImages2);

                    if(count($detailTmpImages1) === 0 && count($detailTmpImages2) === 0 ) {

                        $detailTmpImages3 = array_values(array_map(function($element) {
                            return 'http://lunatalk.co.kr' . $element['src'];
                        }, array_filter($extractedImages, fn($value) => (strpos($value['src'], '/%BB%F3%BC%BC%C0%CC%B9%CC%C1%F6%BF%EB/') !== false))));

                        $detail_image = array_merge_recursive($detailTmpImages1, $detailTmpImages2, $detailTmpImages3);
                    } else {
                        $detail_image = array_merge_recursive($detailTmpImages1, $detailTmpImages2);
                    }

                    $productImage = array_unique($product_image);
                    $detailImage = array_unique($detail_image);

                    if(count($productImage) == 0) {
                        echo $product_url.PHP_EOL;

                        print_r($productImage);

                        echo PHP_EOL;
                        exit;
                    }

                    $images = array();

                    //mac ulimit -Sn 4096
                    foreach ($productImage as $element) :
                        $sourceURL = $element;
                        $sourceBaseName = basename($element);
                        $targetBaseName = Str::random(40).'.'.pathinfo($sourceBaseName, PATHINFO_EXTENSION);

                        if(@file_get_contents($sourceURL,false,NULL,0,1)) {
                            $images['rep'][] = $this->getProductImage('rep', 'true', $sourceURL,$targetBaseName);
                        }
                    endforeach;

                    foreach ($detailImage as $element) :
                        $sourceURL = $element;
                        $sourceBaseName = basename($element);
                        $targetBaseName = Str::random(40).'.'.pathinfo($sourceBaseName, PATHINFO_EXTENSION);

                        if(@file_get_contents($sourceURL,false,NULL,0,1)) {
                            $images['detail'][] = $this->getProductImage('detail', 'false', $sourceURL, $targetBaseName);
                        }
                    endforeach;

                } else {
                    $images['rep'][] = $this->repNoimage;
                    $images['detail'][] = $this->detailNoimage;
                }

                $bar->advance();

                return [
                    'category' => trim($arrayStep1[0]),
                    'name' => trim($arrayStep1[1]),
                    'option' => [
                        'step1' => $optionStep1 ? $optionStep1->id : NULL,
                        'step2' => $optionStep2 ? $optionStep2->id : NULL,
                    ],
                    'price' => trim($arrayStep1[4]),
                    'quantity' => trim($arrayStep1[5]),
                    'barcode' => trim($arrayStep1[6]),
                    'product_url' => trim($arrayStep1[7]),
                    'product_images' => $images,
                ];

            }, array_filter(explode("\n", $fileContents), fn($value) => !is_null($value) && $value !== ''));

            Storage::disk('inside-temp')->put($this->jsonFileName, json_encode($products));

            $bar->finish();
        }

        echo PHP_EOL;
        return 0;
    }

    public function getProductImage($category, $need_thumb, $sourceURL, $targetBaseName)
    {
        file_put_contents($this->imagetTargetRoot . '/' . $targetBaseName, file_get_contents($sourceURL));
        $mediaFile = fopen($this->imagetTargetRoot . '/' . $targetBaseName, 'r');
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Client-Token' => env('APP_MEDIA_CLIENT_KEY')
        ])
            ->attach('media_file', $mediaFile)
            ->post(env('APP_MEDIA_URL') . '/media-upload', [
                'media_name' => 'products',
                'media_category' => $category,
                'need_thumbnail' => $need_thumb
            ]);

        if(!$response->successful()) {
            echo "rep".PHP_EOL;
            print_r($response->json());
            exit;
        }

        $result = json_decode($response->body())->data;

        $task = MediaFileMasters::create([
            'media_name' => $result->media_name,
            'media_category' => $result->media_category,
            'dest_path' => $result->dest_path,
            'file_name' => $result->new_file_name,
            'original_name' => $result->original_name,
            'file_type' => $result->file_type,
            'file_size' => $result->file_size,
            'file_extension' => $result->file_extension,
        ]);

        return $task->id;
    }
}
