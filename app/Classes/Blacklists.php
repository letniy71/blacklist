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

		$arr = explode(',',$str);

		//Собираю двумерный массив из массива для publisher и site
		foreach($arr as $elem)
		{
			//Обработка паблишер
			if(preg_match('#p.+#',$elem))
			{
				$Ids['publisherIds'][] = substr($elem,1);
			}
			//Обработка сайтов
			elseif(preg_match('#s.+#',$elem))
			{
				$Ids['siteIds'][] = substr($elem,1);
			}

		}
			// проверяем на наличе данных в БД
			if(null !== Advertisers::find($id))
			{
				$blacklist = new ModelBlackList;

				if(!empty($publisherId)) //&& null !== Publishers::find($publisherId))
				{
    				$blacklist->publisher_id = $publisherId;
    			} 

    			if(!empty($siteId)) //&& null !== Sites::find($siteId))
    			{
    				$blacklist->site_id = $siteId;
    			}
    			$blacklist->advertiser_id = $id;

    			$blacklist->save();

    			return $Ids;
			} else
			{
				return 'net';
			}	
		
	}
}

