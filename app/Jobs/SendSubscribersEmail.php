<?php

namespace App\Jobs;

use App\Mail\Subscribers;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendSubscribersEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;

    protected $subject;

    protected $messageContent;

    /**
     * Create a new job instance.
     */
    public function __construct($email, $subject, $messageContent)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->messageContent = $messageContent;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new Subscribers($this->subject, $this->messageContent));
    }
}
