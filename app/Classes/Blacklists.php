<?php
namespace App\Classes;
use App\Models\Advertisers;
use App\Models\Publishers;
use App\Models\Sites;
use App\Models\Blacklists as ModelBlackList;

class Blacklists
{
	public static function save(string $str, int $id)
	{

		$arrIds = explode(',',$str);
		foreach($arrIds as $elem)
		{
			$publisherId = null;
			$siteId = null;

			//Обработка паблишер
			if(preg_match('#p.+#',$elem))
			{	
				$publisherId = substr($elem,1);
			}
			//Обработка сайтов
			elseif(preg_match('#s.+#',$elem))
			{
				$siteId = substr($elem,1);
			}


			// проверяем на наличе данных в БД
			if(null !== Advertisers::find($id))
			{
				$blacklist = new ModelBlackList;
				//проверяем есть существует ли паблишер в БД
				if(isset($publisherId) && null !== Publishers::find($publisherId)){
    				$blacklist->publisher_id = $publisherId;
    			} 
				//проверяем есть существует ли сайт в БД
    			if(isset($siteId) && null !== Sites::find($siteId)){
    				$blacklist->site_id = $siteId;
    			}
    			$blacklist->advertiser_id = $id;

    			$blacklist->save();

    			
			} 
		}
	}

	public static function get(int $id)
	{
		$blacklists = ModelBlackList::where('id', $id)->get();
		foreach ($blacklists as $elem) {
    		return $elem;
		}//implode(',', $blacklist);
	}
}



/*try {
        $user = User::findOrFail($request->input('user_id'));
    } catch (ModelNotFoundException $exception) {
        return back()->withError($exception->getMessage())->withInput();
    }
    return view('users.search', compact('user'));
   */