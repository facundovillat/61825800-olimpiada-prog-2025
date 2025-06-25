<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Job;
use Illuminate\Support\Str;

class AssignTokensToJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:assign-tokens-to-jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assigns unique tokens to jobs that do not have one.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Assigning tokens to jobs...');

        $jobsWithoutToken = Job::whereNull('token')->get();

        $count = 0;
        foreach ($jobsWithoutToken as $job) {
            $job->token = Str::random(10);
            $job->save();
            $count++;
        }

        $this->info('$count tokens assigned.');
        $this->info('Token assignment complete.');
    }
}
