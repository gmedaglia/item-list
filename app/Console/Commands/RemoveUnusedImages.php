<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Item;
use Storage;

class RemoveUnusedImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rm-img';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes stored images that are not associated to any item.';

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
        $deletedImgCount = 0;
        collect(Storage::files('public/images'))
            ->map(function ($imgFilePath) {
                return basename($imgFilePath);
            })
            ->each(function ($imgFileName) use (&$deletedImgCount) {
                $count = Item::where('image', $imgFileName)->count();
                if ($count == 0) {
                    Storage::delete('public/images/' . $imgFileName);
                    $deletedImgCount++;
                    $this->info('Image ' . $imgFileName . ' deleted.');
                }
            });

        $this->info('Total images deleted: ' . $deletedImgCount);
    }
}
