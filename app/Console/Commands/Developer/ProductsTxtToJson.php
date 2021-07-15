<?php

namespace App\Console\Commands\Developer;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;
use App\Models\Codes;
use Illuminate\Support\Str;

class ProductsTxtToJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:txt-to-json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '상품 txt 파일을 json 으로 변경.';

    protected $spaceName = 'products';
    protected $txtFileName = 'products.txt';
    protected $jsonFileName = 'products.json';
    protected $imagetTargetRoot = '/tmp/lunatalk/images/origin-images';

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

            $bar = $this->output->createProgressBar(count(array_filter(explode("\n", $fileContents), fn($value) => !is_null($value) && $value !== '')));
            $bar->start();

            $products = array_map(function($element) use($bar) {
                $arrayStep1 = explode("," , $element);

                $optionStep1 = Codes::select()->where('code_name', trim($arrayStep1[2]))->first();
                $optionStep2 = Codes::select()->where('code_name', trim($arrayStep1[3]))->first();

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

                    // TODO: rep 이미지 없는게 있는데??? noimage 처리..
                    foreach ($productImage as $element) :
                        $sourceURL = $element;
                        $sourceBaseName = basename($element);
                        $targetBaseName = Str::random(40).'.'.pathinfo($sourceBaseName, PATHINFO_EXTENSION);

                        if (!file_exists($this->imagetTargetRoot)) {
                            mkdir($this->imagetTargetRoot, 0777, true);
                        }
                        if(@file_get_contents($sourceURL,false,NULL,0,1)) {
                            file_put_contents($this->imagetTargetRoot . '/' . $targetBaseName, file_get_contents($sourceURL));
                            $images['rep'][] = $this->imagetTargetRoot . '/' . $targetBaseName;
                        }
                    endforeach;

                    foreach ($detailImage as $element) :
                        $sourceURL = $element;
                        $sourceBaseName = basename($element);
                        $targetBaseName = Str::random(40).'.'.pathinfo($sourceBaseName, PATHINFO_EXTENSION);

                        if (!file_exists($this->imagetTargetRoot)) {
                            mkdir($this->imagetTargetRoot, 0777, true);
                        }
                        if(@file_get_contents($sourceURL,false,NULL,0,1)) {
                            file_put_contents($this->imagetTargetRoot . '/' . $targetBaseName, file_get_contents($sourceURL));
                            $images['detail'][] = $this->imagetTargetRoot . '/' . $targetBaseName;
                        }
                    endforeach;
                }

                $bar->advance();

                return [
                    'category' => trim($arrayStep1[0]),
                    'name' => trim($arrayStep1[1]),
                    'option' => [
                        'step1' => $optionStep1 ? $optionStep1->code_id : NULL,
                        'step2' => $optionStep2 ? $optionStep2->code_id : NULL,
                    ],
                    'price' => trim($arrayStep1[4]),
                    'stock' => trim($arrayStep1[5]),
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
}
