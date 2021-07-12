<?php

namespace App\Console\Commands\Developer;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;
use App\Models\Codes;

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

//                    print_r($extractedImages);

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
                    $tmpImages1 = array_values(array_map(function($element) {
                        return 'http://lunatalk.co.kr/' . $element['src'];
                    }, array_filter($extractedImages, fn($value) => (strpos($value['src'], '/detimg') !== false))));

                    $tmpImages2 = array_values(array_map(function($element) {
                        return 'http://lunatalk.co.kr' . $element['src'];
                    }, array_filter($extractedImages, fn($value) => (strpos($value['src'], '/ACC/') !== false))));
                    $tmpImages2 = array_unique($tmpImages2);


                    if(count($tmpImages1) === 0 && count($tmpImages2) === 0) {

                        echo PHP_EOL;
                        echo $product_url.PHP_EOL;
                        print_r($extractedImages);

                        echo PHP_EOL;

                        exit;
                    }

                    // 노멀 상세 이미지.





//                    $tmpImages = array_values(array_map(function($element) {
//
//                        print_r($element);
//
//                        if(trim($element['classText']) == 'BigImage') {
//                            return [
//                                'product_image' => 'http:' . $element['src']
//                            ];
//                        } else {
//                            return [
//                                'detail_image' => 'http://lunatalk.co.kr/' . $element['src']
//                            ];
//                        }
//
//                    }, array_filter($extractedImages, fn($value) => (trim($value['classText']) == 'BigImage') || (strpos($value['src'], '/detimg') !== false))));



//                    foreach ($tmpImages as $element) :
//                        $images['origin'][key($element)][] = $element[key($element)];
//
//                        $imageBaseName = basename($element[key($element)]);
//
//                        if (env('APP_ENV') == 'development') {
//                            file_put_contents('/var/www/site/lunatalk.co.kr/dev.media/public/products/origin-images/' . $imageBaseName, file_get_contents($element[key($element)]));
//                            $images['we'][key($element)][] = '/var/www/site/lunatalk.co.kr/dev.media/public/products/origin-images/' . $imageBaseName;
//                        } else {
//                            if (!file_exists('/tmp/lunatalk/origin-images')) {
//                                mkdir('/tmp/lunatalk/origin-images', 0777, true);
//                            }
//                            file_put_contents('/tmp/lunatalk/origin-images/' . $imageBaseName, file_get_contents($element[key($element)]));
//                            $images['we'][key($element)][] = '/tmp/lunatalk/origin-images/' . $imageBaseName;
//                        }
//                    endforeach;
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

            // 테스트 코드.
//            echo "\ntest : \n";
//            $fileContents = Storage::disk('inside-space')->get($this->spaceName . '/' . $this->jsonFileName);
//            print_r(json_decode($fileContents, true));

        }

        echo PHP_EOL;
        return 0;
    }
}
