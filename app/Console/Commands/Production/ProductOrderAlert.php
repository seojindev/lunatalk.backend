<?php

namespace App\Console\Commands\Production;

use Illuminate\Console\Command;
use App\Models\OrderMasters;

class ProductOrderAlert extends Command
{
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


            OrderMasters::where('id', $item['id'])
                ->update(['notice' => 'Y']);
        }

        return 0;
    }
}
