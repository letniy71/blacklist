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
		// проверяем на наличе данных рекламодателя в БД
		if(null == Advertisers::find($id))
		{
			throw new \Exception('The Advertisers is not in the DB!');
		}

		//формируем массив id паблишеров и сайтов
		$arrIds = explode(',',$str);
		foreach($arrIds as $elem)
		{
			$publisherId = null;
			$siteId = null;

			//Обработка паблишер , проверка на наличии в БД и генерирование исключения
			if(preg_match('#p.+#',$elem))
			{	
				$publisherId = substr($elem,1);
				if(null ==(Publishers::find($publisherId))){
					throw new \Exception('The Publishers is not in the DB!');
				}
			}
			//Обработка сайтов, проверка на наличии в БД и генерирование исключения
			elseif(preg_match('#s.+#',$elem))
			{
				$siteId = substr($elem,1);
				if(null ==(Sites::find($siteId))){
					throw new \Exception('The Sites is not in the DB!');
				}
			}

			//Создание новой записи
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