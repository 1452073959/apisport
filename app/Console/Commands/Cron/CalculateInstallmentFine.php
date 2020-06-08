<?php

namespace App\Console\Commands\Cron;

use App\Models\User;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\UserMember;
use Illuminate\Support\Str;
class CalculateInstallmentFine extends Command
{
    protected $signature = 'cron:calculate-installment-fine';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '描述';

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

//        $user=User::all();
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
