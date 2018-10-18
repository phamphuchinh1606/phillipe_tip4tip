<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Common;
use App\Common\Utils;
use App\Model\Message;
use App\User;

class MessagesAPIController extends Controller
{
    /*===========================================================================
      * CONTROLLER FOR API
      * ==========================================================================*/
    public function messagesNew($tipsterId){
    	if(isset($tipsterId)){
			$messages = Message::countYetNotRead($tipsterId, 10);
			$pathImage = asset(Utils::$PATH__IMAGE);
	        foreach ($messages as $message){
	            $message['senderAvatar'] = User::getUserByID($message->author)->avatar;
	            $message['senderUsername'] = User::getUserByID($message->author)->username;
	            $message['pathImage'] = $pathImage;
	            $message['dateSend'] = Common::dateFormatText($message->created_at);
	            $message['contentShow'] = strip_tags(str_limit($message->content, 30));
                $message['titleShow'] = strip_tags(str_limit($message->title, 30));
	        }

	        $countMessageNotRead = Message::countMessageNotRead($tipsterId, 10000);
	        if($countMessageNotRead > 9){
	            $result = '9 +';
	        }else{
	            $result = $countMessageNotRead;
	        }
	        $jsonValue = [
	            "messages" => $messages,
	            "messageAmount" => $result
	        ];
	        return response()->json($jsonValue, 201);
    	}
    	$jsonValue = [
	            "messages" => [],
	            "messageAmount" => 0
	        ];
        return response()->json($jsonValue, 201);
    }

     public function messagesAll($tipsterId){
    	if(isset($tipsterId)){
    		$countMessages = Message::countMessageAllInbox($tipsterId);
    		$messages = Message::getMessageOfUser($tipsterId);
    		foreach ($messages as $message){
	            $message['dateSend'] = Common::dateFormat($message->created_at, 'd/m/Y');
	            $message['contentShow'] = strip_tags(str_limit($message->content, 50));
	            $message['title'] = strip_tags(str_limit($message->title, 70));
	        }
	        $jsonValue = [
	            "messages" => $messages,
	            "countMessages" => $countMessages
	        ];
	        return response()->json($jsonValue, 201);
    	}
    	$jsonValue = [
	            "messages" => [],
	            "countMessages" => 0
	        ];
        return response()->json($jsonValue, 201);
    }

    public function show($messageId){
    	$message = [];
    	if(isset($messageId)){
    		$message = Message::find($messageId);
	        $message->read_is = 1;
	        $message->save();
	        $message['authorMess'] = User::getUserByID($message->author)->username;
	        $message['receiverMess'] = User::getUserByID($message->receiver)->username;
	        $message['dateSend'] = Common::dateFormatText($message->created_at);
    	}
        $jsonValue = [ "message" => $message];
        return response()->json($jsonValue, 201);
    }
}
