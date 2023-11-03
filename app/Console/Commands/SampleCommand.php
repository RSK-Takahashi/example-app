<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SampleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:sample-command';
    // 206-02
    protected $signature = 'sample-command';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';
    // 206-02
    protected $description = 'Sample Command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 206-02
        echo 'このコマンドはサンプルです。';
        return 0;
    }
}
