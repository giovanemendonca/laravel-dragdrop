<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function itemView()
    {
    	$panddingItem = Item::where('status',0)->orderBy('order')->get();
    	$completeItem = Item::where('status',1)->orderBy('order')->get();
        
    	return view('dragAndDroppable',compact('panddingItem','completeItem'));
    }

    public function updateItems(Request $request)
    {
    	$input = $request->all();

    	foreach ($input['panddingArr'] as $key => $value) {
    		$key = $key+1;
    		Item::where('id',$value)->update(['status'=>0,'order'=>$key]);
    	}

    	foreach ($input['completeArr'] as $key => $value) {
    		$key = $key+1;
    		Item::where('id',$value)->update(['status'=>1,'order'=>$key]);
    	}

    	return response()->json(['status'=>'success']);
    }
    
    public function updateItemsTeste(Request $request)
    {
    	$input = $request->all();
        
        if(!empty($input['paddingArr'])){
            foreach ($input['panddingArr'] as $key => $value) {
    		$key = $key+1;
    		Item::where('id',$value)->update(['status'=>0,'order'=>$key]);
            }            
        }       
    	
        if(!empty($input['completeArr'])){
            foreach ($input['completeArr'] as $key => $value) {
                $key = $key+1;
                Item::where('id',$value)->update(['status'=>1,'order'=>$key]);
            }            
        }

    	return response()->json(['status'=>'success']);
    }
    
    public function show()
    {
        //Exemplo vídeo Youtube: https://www.youtube.com/watch?v=6wn8hpUcEcM
    	$panddingItem = Item::where('status',0)->orderBy('title')->get();
    	$completeItem = Item::where('status',1)->orderBy('title')->get();
        
    	return view('dragAndDrop',compact('panddingItem','completeItem'));
    }
    
    public function workFlow()
    {
    	$panddingItem = Item::where('status',0)->orderBy('title')->get();
    	$completeItem = Item::where('status',1)->orderBy('title')->get();
        
    	return view('workFlow',compact('panddingItem','completeItem'));
    }
    
}
