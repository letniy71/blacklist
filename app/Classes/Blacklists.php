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
				//проверяем есть существует ли паблишер или сайт в БД
				if(null !== Publishers::find($publisherId) or null !== Sites::find($siteId)){
					$blacklist = new ModelBlackList;
					if(isset($publisherId)){
	    				$blacklist->publisher_id = $publisherId;

	    			} 
	    			if(isset($siteId)){
	    				$blacklist->site_id = $siteId;
	    			}
	    			$blacklist->advertiser_id = $id;

	    			$blacklist->save();
	    		}

    			
			} 
		}
	}

	public static function get(int $id)
	{
		$arr = array();
		$blacklists = ModelBlackList::where('advertiser_id',$id)->get();
		foreach($blacklists as $blacklist){
			foreach($blacklist->site as $site){
				$arr[] = 's' .$site->id;
			}
			foreach($blacklist->publisher as $publisher){
				$arr[] = 'p' . $publisher->id;
			}
		
		}

		$str = implode(',',$arr);




		return $str;
	}
}



/*try {
        $user = User::findOrFail($request->input('user_id'));
    } catch (ModelNotFoundException $exception) {
        return back()->withError($exception->getMessage())->withInput();
    }
    return view('users.search', compact('user'));
   */