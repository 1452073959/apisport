<?php

namespace App\Console;

use App\Console\Commands\Cron\CalculateInstallmentFine;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
use App\Models\UserMember;
use Illuminate\Support\Str;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        CalculateInstallmentFine::class

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        // daily() 代表每天凌晨 00:00 执行
//        $schedule->command('CalculateInstallmentFine')->daily();
        $schedule->call(function () {
            $user=UserMember::all();
            foreach ($user as $k=>$v)
            {
                if(strtotime(Carbon::now())>strtotime($v['end_time'])){
                    $user[$k]['membership']=0;
                    $user[$k]['codenot']=0;
                    $v->save();
                }else{
                    $user[$k]['code']=$this->GetRandStr(3);
                    $user[$k]['code'].=Str::random($length = 3);
                    $user[$k]['membership']=1;
                    $user[$k]['codenot']=0;
                    $v->save();
                }
            }
        })->daily();


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    function GetRandStr($length){

        $str='abcdefghijklmnopqrstuvwxyz0123456789';
        $len=strlen($str)-1;
        $randstr='';
        for($i=0;$i<$length;$i++){

            $num=mt_rand(0,$len);

            $randstr .= $str[$num];

        }
        return $randstr;

    }
}
