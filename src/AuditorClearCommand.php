<?php

namespace Hasnularief\Auditor;

use Illuminate\Console\Command;

class AuditorClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auditor:clear {--keep-month=}';

    protected $keepMonth = 1;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will clear auditor table';

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
        $keepMonth = $this->option('keep-month') ?: 1;

        $from = Carbon::now()->addMonths(-1 * $keepMonth)->format('Y-m-d');

        Auditor::where('created_at', '<', $from)->delete();
        
        info("Auditor data before {$from} is deleted");
    }
}
