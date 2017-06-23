<?php

namespace App\Console\Commands;

use App\DripEmailer;
use App\User;
use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send{user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '发送邮件给用户 Send emails to user';

    protected $drip;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DripEmailer $drip)
    {
        parent::__construct();

        $this->drip = $drip;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $this->drip->send(User::find($this->argument('user')));
    }
}
