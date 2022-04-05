<?php

namespace App\Console\Commands\Production;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServerErrorException;
use Illuminate\Console\Command;
use App\Models\OrderMasters;
use App\Supports\AuthTrait;

class ProductOrderAlert extends Command
{
    use AuthTrait {
        AuthTrait::sendSMS as AuthTraitSendSMS;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prod:product-order-alert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '주문 알림 스케쥴';

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
    public function handle() : int
    {
        $task = OrderMasters::whereIn('state', ['5100030', '5100040'])
            ->where('notice', 'N')
            ->orderBy('id', 'asc')
            ->get();

        foreach ($task->toArray() as $item) {

            $message = "[루나톡]" . $item['order_name'] . ' 주문이 완료 되었습니다.';
            $this->AuthTraitSendSMS(env('SMS_PRODUCT_NOTICE_NO'), $message);

            OrderMasters::where('id', $item['id'])
                ->update(['notice' => 'Y']);
        }

        return 0;
    }
}
