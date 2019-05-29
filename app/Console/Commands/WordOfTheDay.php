<?php

namespace App\Console\Commands;

use App\Models\OrderDetail;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Console\Command;

class WordOfTheDay extends Command
{
    const FREE = 1;
    const USING = 3;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'word:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status room';

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
     * @return mixed
     */
    public function handle()
    {
        $orderDetails = OrderDetail::where('start_date', '<=', Carbon::now()->format('Y-m-d'))
                ->where('end_date', '>=', Carbon::now()->format('Y-m-d'))->get();
        $rooms = Room::whereStatusId(self::USING)->get();
        foreach ($rooms as $room) {
            $room->status_id = self::FREE;
            $room->save();
        }

        foreach ($orderDetails as $orderDetail) {
            $room = Room::find($orderDetail->room_id);
            $room->status_id = self::USING;

            $room->save();
        }
    }
}
