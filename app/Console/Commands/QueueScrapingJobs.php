<?php

namespace Courses\Console\Commands;

use Illuminate\Console\Command;

class QueueScrapingJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wcfm:scrape';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initiates a scrape of the OSU Course Catalog.';

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
        \Queue::push('Courses\Jobs\Scraper\ScrapeSubjects@scrape', ['term' => 'F15', 'campus' => 'corvallis']);
        \Queue::push('Courses\Jobs\Scraper\ScrapeSubjects@scrape', ['term' => 'Su15', 'campus' => 'corvallis']);
    }
}
