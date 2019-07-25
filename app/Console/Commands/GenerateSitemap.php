<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Article;
use App\Topic;

class GenerateSitemap extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
            
        // modify this to your own needs
        $sitemap = Sitemap::create(config('app.url'));
            
        $sitemap->add(Url::create("/"));
        
        Article::all()->each(function (Article $article) use ($sitemap) {
            $sitemap->add(Url::create("/{$article->topic->slug}/{$article->slug}"));
        });
        
        Topic::all()->each(function (Topic $topic) use ($sitemap) {
            $sitemap->add(Url::create("/$topic->slug"));
        });
        
        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}