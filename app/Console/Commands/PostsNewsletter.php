<?php

namespace App\Console\Commands;

use App\User;
use App\Post;
use \App\Notifications\PostsNewsletter as PostsNewsletterNotification;
use Illuminate\Console\Command;

class PostsNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletters:post {start} {end}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mailing the Post Model. For a certain period("start" and "end" arguments. Format "2016-12-31")';

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
    public function handle()
    {
        $users = User::all();
        $posts = \App\Post::where([
                    ['created_at', '>=', $this->argument('start')],
                    ['created_at', '<=', $this->argument('end')],
                    ['public', true],
                ])->get();

        $users->map->notify(new PostsNewsletterNotification($posts, $this->argument('start'), $this->argument('end')));
        

        $this->line($posts);
    }
}
