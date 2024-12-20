<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\NotifyController;
use Illuminate\Console\Command;

class SubscriberNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:subscriber_notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send notification';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $controller = new NotifyController();
        // Directly call the controller's method
        $response = $controller->subscriberWhatsappNotify();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
