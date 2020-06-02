<?php

namespace App\Http\Controllers\Api;

use App\Models\SMember;
use App\Models\UserMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Models\User;
use DB;
use Response;
use Carbon\Carbon;
class MemberController extends Controller
{
    //
    //会员卡列表
    public function memberlist()
    {
        $member=SMember::all();
        return $member;
    }



//    用户会员码核销
    public function membercode(Request $request)
    {
        $data=$request->all();
        if($data['code']==''){
            return $this->success('请输入会员码');
        }
      $user=UserMember::where('code',$data['code'])->first();
      if(!$user){
          return $this->success('该会员码不存在');
      }else{
          if($user['codenot']==1){
              return $this->success('该会员码今日已使用');
          }
          $user->codenot=1;
          $user->save();
          return $this->success('核销成功');
      }

    }

}
