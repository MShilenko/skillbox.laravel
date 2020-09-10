<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\EntitiesReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EntitiesCounting implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var integer количество повторов, в случае ошибки в Работе */
    public $tries = 2;
    /** @var boolean если на момент выполнения Работы удалена Модель, такая Работа будет удалена из очереди */
    public $deleteWhenMissingModels = true;
    private $user;
    private $models;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($models)
    {
        $this->user = User::find(Auth::id());
        $this->models = $models;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $result = [];

        foreach ($this->models as $model) {
            $model = "\App\\" . $model;
            $result[$model] = $model::all()->count();            
        }

        $this->user->notify(new EntitiesReport($result));
    }
}
