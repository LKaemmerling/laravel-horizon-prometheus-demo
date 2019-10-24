<?php

namespace App\Console\Commands;

use App\Jobs\FailedJob;
use App\Jobs\GenericJob;
use Illuminate\Console\Command;

class GenerateWorkload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'workload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate some workload on different queues';

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
        $runs = 500;
        for ($i = 0; $i < $runs; $i++) {
            dispatch(with(new GenericJob())->onQueue('default'));
            dispatch(with(new FailedJob())->onQueue('high-load'));
            dispatch(with(new GenericJob())->onQueue('high-load'));
            dispatch(with(new GenericJob())->onQueue('high-load'));
            dispatch(with(new GenericJob())->onQueue('high-load'));
            dispatch(with(new GenericJob())->onQueue('high-load-2'));
            dispatch(with(new GenericJob())->onQueue('high-load-2'));
            dispatch(with(new GenericJob())->onQueue('high-load-2'));
            dispatch(with(new GenericJob())->onQueue('high-load-2'));
            dispatch(with(new GenericJob())->onQueue('high-load-2'));
            dispatch(with(new GenericJob())->onQueue('high-load-2'));
            dispatch(with(new GenericJob())->onQueue('high-load-2'));
            dispatch(with(new GenericJob())->onQueue('high-load-2'));
        }
        $this->info('I have dispatched ' . $runs . ' jobs on default and ' . ($runs * 4) . ' on high load and '. ($runs * 8) . ' on high load2');
    }
}
