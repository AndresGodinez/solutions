<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \stdClass;
use config;
use DB;

class Menu extends ModelBase
{
    //

	public static function getMenu()
	{

	$items = [
				'home'          => ['url' => 'menu-test'],
				'about'         => [],
				'contact-us'    => [],
				'login'         => [],
				'register'      => [],
				'options'       =>
				[
					'submenu' =>
					[
						'about'     => [],
						'company'   => []
					]
				]
			];


		$user = "munoznd";
        $raw_menu  = DB::table('wpx_menu_users_access')
            ->join('wpx_menu_cat', 'wpx_menu_users_access.id_cat', '=', 'wpx_menu_cat.id_cat')
            ->join('wpx_menu_modulos', 'wpx_menu_users_access.id_modulo', '=', 'wpx_menu_modulos.id_modulo')
            ->where('wpx_menu_users_access.id_user', '=', $user)
            ->where('wpx_menu_cat.id_cat', '=', 1)
            ->orderBy('wpx_menu_cat.id_cat', 'asc')
            ->select('wpx_menu_cat.id_cat', 'wpx_menu_cat.name as name_cat', 'wpx_menu_modulos.name as name_mod', 'wpx_menu_modulos.link as link_mod')
            ->get();

		$menu    = array();
		$submenu = array();
		$items   = array();
		$title   = $raw_menu[0]->name_cat;
		$id = $raw_menu[0]->id_cat;

		$subaux = array();
		//echo count($raw_menu);

		foreach( $raw_menu as $key => $item )
		{
			$aux =  array();
			if( $id !== $item->id_cat )
			{
				//$submenu[$title]  = [ 'submenu' => array( $item->name_mod  => [ 'url' => $item->link_mod ] ) ];
				//$submenu[$title]  = [ 'submenu' => array( $item->name_mod  => [ 'url' => $item->link_mod ] ) ];
				$id = $item->id_cat;
				$title = $item->name_cat;
			}else
			{

				//$submenu[$title]['sumenu'] = array( $item->name_mod  => [ 'url' => $item->link_mod ] );
				//$subaux = array();
				foreach( $raw_menu as $subkey => $subitem )
				{
					$sub = $id;
					$name = '';
					$url = '';
					if( $sub == $subitem->id_cat )
					{
						//$sub = $subitem->id_cat;
						$name = $subitem->name_mod;
						$url = $subitem->link_mod;
						//echo $subkey.$name.$url;
						array_push($subaux, [ $name  => $url ]);
						$sub = $subitem->id_cat;
					}
					//echo "\n";
				}
				array_push($items,$subaux);
				$subaux = array();
			}
			$submenu[$title]  = [ 'submenu' => array( $item->name_mod  => [ 'url' => $item->link_mod ] ) ];
			//$submenu[$title]  = [ 'submenu' => $items ];
			//$items   = array();

			//return $submenu;



		}
		//array_push($submenu,['submenu' => $items]);
		return $submenu;
		//return $items;
	}


	public static function getMenu2($user)
	{
		$global_url  = config('pages.globals.url');


        $raw_menu  = DB::table('wpx_menu_users_access')
            ->leftjoin('wpx_menu_cat', 'wpx_menu_users_access.id_cat', '=', 'wpx_menu_cat.id_cat')
            ->leftjoin('wpx_menu_modulos', 'wpx_menu_users_access.id_modulo', '=', 'wpx_menu_modulos.id_modulo')
            ->where('wpx_menu_users_access.id_user', '=', $user)
            ->where('wpx_menu_modulos.active', '=', 1)
            ->where('wpx_menu_cat.active', '=', 1)
            ->orderBy('wpx_menu_cat.id_cat', 'asc')
            ->select('wpx_menu_cat.id_cat', 'wpx_menu_cat.name as name_cat', 'wpx_menu_modulos.name as name_mod', 'wpx_menu_modulos.link as link_mod')
            ->get();

		if(empty($raw_menu)){
			return [];
		}

		$menu    = array();
		$submenu = array();
		$items   = array();
		$title   = $raw_menu[0]->name_cat;
		$id = $raw_menu[0]->id_cat;

		$subaux = array();

		for ($x = 0; $x < count($raw_menu); $x++)
		{
			$sub = $id;
			if( $id == $raw_menu[$x]->id_cat )
			{
				for ($y = 0; $y < count($raw_menu); $y++)
				{
					$name = '';
					$url = '';
					if( $sub == $raw_menu[$y]->id_cat )
					{
						$name = $raw_menu[$y]->name_mod;
						$url = $raw_menu[$y]->link_mod;
						$subaux[$name] = [ 'url' => $global_url.$url ];
						$sub = $raw_menu[$y]->id_cat;
					}
				}
				array_push($items,$subaux);
				$subaux = array();
			}
			else
			{
				$id = $raw_menu[$x]->id_cat;
				$title = $raw_menu[$x]->name_cat;
			}
			// Exceptions -> they has only one element
			if($raw_menu[$x]->id_cat==41 || $raw_menu[$x]->id_cat==39 || $raw_menu[$x]->id_cat==38 || $raw_menu[$x]->id_cat==31 || $raw_menu[$x]->id_cat==30 || $raw_menu[$x]->id_cat==29 || $raw_menu[$x]->id_cat==26 || $raw_menu[$x]->id_cat==25 || $raw_menu[$x]->id_cat==19 || $raw_menu[$x]->id_cat==17 || $raw_menu[$x]->id_cat==14)
			{
				$name = $raw_menu[$x]->name_mod;
				$url = $raw_menu[$x]->link_mod;
				$submenu[$title]  = [ 'submenu' => array( $name => [ 'url' => $global_url.$url] ) ];
			}
			else
			{
				if(isset($items[0]))
				{
					$submenu[$title]  = [ 'submenu' => $items[0] ];
				}
				else
				{
					$submenu[$title]  = [ 'submenu' => $items ];
				}
				$items   = array();
			}
		}
		return $submenu;
	}
}
