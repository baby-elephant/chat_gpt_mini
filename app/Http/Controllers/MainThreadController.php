<?php

namespace App\Http\Controllers;

use App\Services\View\MainThreadService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use OpenAI;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Spatie\Ignition\Solutions\OpenAi\OpenAiPromptViewModel;

class MainThreadController extends Controller
{

    private MainThreadService $mainThreadService;

    public function __construct(
        MainThreadService $mainThreadService,
    )
    {
        $this->mainThreadService = $mainThreadService;
    }

    /**
     * main_thread.blade.phpを表示
     *
     * @param string $chat_ulid
     * @return View
     */
    public function viewMainThread(?string $chat_ulid = 'new'): View{
        Log::info('来てる？');

        // $chat_ulidに紐づくchat_historiesを取得.user_idもチェックする
        $chat_infos = ($chat_ulid === 'new') ? null : $this->mainThreadService->getChatInfos(Auth::guard('web')->user()->id, $chat_ulid);
        Log::info('$chat_infos');
        Log::info(print_r($chat_infos, true));

        $chat_history_infos = $this->mainThreadService->getAllChatsForChatHistory(Auth::guard('web')->user()->id);
        // Log::info(print_r($chat_infos, true));
        Log::info('$chat_history_infos');
        Log::info(print_r($chat_history_infos, true));

        // 一連のmessagesを取得
        return view('main_thread/main_thread', compact('chat_ulid', 'chat_infos', 'chat_history_infos'));
    }

    /**
     * ユーザープロンプトを保存
     *
     * @param Request $request
     * @return void
     */
    public function saveUserPromtRequest(Request $request) {
        Log::info(print_r($request->all(), true));
        // 今後userとchta_ulidの紐づき確認処理を追加する.

        // 諸々の保存処理
        $result_array = $this->mainThreadService->saveUserPrompt(Auth::guard('web')->user()->id, $request->chat_ulid, $request->role, $request->prompt, $request->parent_chat_history_id);

        return response()->json($result_array, $result_array['status']);
    }

    public function deleteChat(Request $request) {
        return $this->mainThreadService->deleteRelatedChatUlidRecode($request->chat_ulid);
    }

    /**
     * OpenAIのクライアントを作成
     */
    public function getClient() {
        $yourApiKey = config('app.open_ai_api_key');
        $client = OpenAI::client($yourApiKey);
        return $client;
    }

    /**
     * ChatGPTへの普通のリクエスト
     */
    public function chatGPTRequest() {
        Log::info(__METHOD__);

        $client = $this->getClient();

        $response = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => 'Hello!'],
            ],
        ]);

        $response->id; // 'chatcmpl-6pMyfj1HF4QXnfvjtfzvufZSQq6Eq'
        $response->object; // 'chat.completion'
        $response->created; // 1677701073
        $response->model; // 'gpt-3.5-turbo-0301'

        foreach ($response->choices as $result) {
            $result->index; // 0
            $result->message->role; // 'assistant'
            $result->message->content; // '\n\nHello there! How can I assist you today?'
            $result->finishReason; // 'stop'
            Log::info(print_r($result, true));
        }

        $response->usage->promptTokens; // 9,
        $response->usage->completionTokens; // 12,
        $response->usage->totalTokens; // 21

        $response->toArray(); // ['id' => 'chatcmpl-6pMyfj1HF4QXnfvjtfzvufZSQq6Eq', ...]
        Log::info(print_r($response->toArray(), true));
    }


    /**
     * ChatGPTへのストリームリクエスト
     */
    public function chatGPTStreamRequest(int $parent_chat_history_id) {
        Log::info('スタート' . __METHOD__);

        $messages = $this->mainThreadService->getChatMessagesForApi(Auth::guard('web')->user()->id, $parent_chat_history_id);
        Log::info(print_r($messages, true));

        $client = $this->getClient();
        $stream = $client->chat()->createStreamed([
            'model' => 'gpt-4',
            'messages' => isset($messages) ? $messages : [],
        ]);

        return response()->stream(function() use($stream, $parent_chat_history_id) {
            try{
                $assistant_content = '';
                foreach($stream as $response){
                    $response->choices[0]->toArray();
                    $result_array = ['content' => ''];

                    if(empty($response->choices[0]->toArray()['finish_reason'])){
                        $responseContent = $response->choices[0]->toArray()['delta']['content'];
                        $assistant_content = $assistant_content . $responseContent;
                        $result_array['content'] = $responseContent;
                        print "data: ". json_encode($result_array) . "\n\n";
                    }else {
                        // ここでassistantのcontentを保存する.
                        $chat_history_id = $this->mainThreadService->saveAssistantContent($assistant_content, $parent_chat_history_id);

                        print "event: addChatHistoryId" . PHP_EOL;
                        print "data: ". json_encode($chat_history_id) . "\n\n";
                    }
                    ob_flush();
                    flush();
                }
            }catch(Exception $e) {
                print "event: close" . PHP_EOL;
                ob_flush();
                flush();
            }

        }, 200, [
                'Content-Type' => 'text/event-stream',
                'Cache-Control' => 'no-cache',
                'Connection' => 'keep-alive',
        ]);
    }

}
