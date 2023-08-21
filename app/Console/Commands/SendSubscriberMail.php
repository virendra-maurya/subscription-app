<?php

namespace App\Console\Commands;

use App\Mail\NewPostNotification;
use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SendSubscriberMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-subscriber-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to subscribers.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::notNotified()->with('website.subscribedUsers')->get();

        foreach ($posts as $post) {
            if ($post->website->subscribedUsers->count()){
                $post->website->subscribedUsers->each(function ($user) use($post){
                    $this->info("UserId -> {$user->id} | PostId -> {$post->id} | WebsiteId -> {$post->website->id}");
                    Mail::to($user)->queue(new NewPostNotification($post, $user));
                });
                $post->is_notified = 1;
                $post->save();
            }
        }
    }
}
