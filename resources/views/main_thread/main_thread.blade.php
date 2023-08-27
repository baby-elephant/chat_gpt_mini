<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>HTML Sample</title>
    <link rel="stylesheet" href="{{ asset('css/main_thread.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chat_option.css') }}">
    <script src="{{ asset('js/main_thread.js') }}"></script>
    <meta id="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="overflow-hidden w-full h-full relative flex z-0">
        {{-- chat履歴 --}}
        @include('main_thread/chat_history')

        {{-- メインスレッド --}}
        <div class="relative flex h-full max-w-full flex-1 overflow-hidden">
            <div class="flex h-full max-w-full flex-1 flex-col">
                <main class="relative h-full w-full transition-width flex flex-col overflow-auto items-stretch flex-1">
                    <div class="absolute right-4 top-2 z-10 hidden flex-col gap-2 md:flex"></div>
                    <div class="flex-1 overflow-auto">
                        <div class="react-scroll-to-bottom--css-wfbal-79elbk h-full dark:bg-gray-800">
                            <div class="react-scroll-to-bottom--css-wfbal-1n7m0yu">
                                <div id="threadArea" class="flex flex-col text-sm dark:bg-gray-800">
                                    {{-- システムテキスト --}}
                                    <div
                                        id="system-prompt-area"
                                        class="group w-full text-gray-800 dark:text-gray-100 border-b border-black/10 dark:border-gray-900/50 dark:bg-gray-800">
                                        <div
                                            class="flex p-4 gap-4 text-base md:gap-6 md:max-w-2xl lg:max-w-[38rem] xl:max-w-3xl md:py-6 lg:px-0 m-auto">
                                            <div
                                                class="flex flex-col w-full py-[10px] flex-grow md:py-4 md:pl-4 relative border border-black/10 bg-white dark:border-gray-900/50 dark:text-white dark:bg-gray-700 rounded-xl shadow-xs dark:shadow-xs">
                                                <textarea id="system-prompt-textarea" tabindex="0" data-id="request-:rbh:-0" rows="1" placeholder="system text."
                                                    class="m-0 w-full resize-none border-0 bg-transparent p-0 pr-10 focus:ring-0 focus-visible:ring-0 dark:bg-transparent md:pr-12 pl-3 md:pl-0"
                                                    style="height: 24px; overflow-y: hidden;"></textarea>
                                                <button id="system-prompt-textarea-button"
                                                    class="absolute p-1 rounded-md md:bottom-3 md:p-2 md:right-3 dark:hover:bg-gray-900 dark:disabled:hover:bg-transparent right-2 disabled:text-gray-400 enabled:bg-brand-purple text-white bottom-1.5 transition-colors disabled:opacity-40"
                                                    {{-- style="" disabled="" --}}>
                                                    <span class="" data-state="closed">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="none"
                                                            class="h-4 w-4 m-1 md:m-0" stroke-width="2">
                                                            <path
                                                                d="M.5 1.163A1 1 0 0 1 1.97.28l12.868 6.837a1 1 0 0 1 0 1.766L1.969 15.72A1 1 0 0 1 .5 14.836V10.33a1 1 0 0 1 .816-.983L8.5 8 1.316 6.653A1 1 0 0 1 .5 5.67V1.163Z"
                                                                fill="currentColor">
                                                            </path>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- ここにChatを表示していく --}}
                                    @include('main_thread/chat_of_user')
                                    @include('main_thread/chat_of_chat_gpt')
                                </div>
                                <div class="h-32 md:h-48 flex-shrink-0"></div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-full border-t md:border-t-0 dark:border-white/20 md:border-transparent md:dark:border-transparent md:bg-vert-light-gradient bg-white dark:bg-gray-800 md:!bg-transparent dark:md:bg-vert-dark-gradient pt-2 md:-left-2">
                        <div class="relative flex h-full flex-1 items-stretch md:flex-col" role="presentation">
                            {{-- Regenerate response --}}
                            <div class="">
                                <div class="h-full flex ml-1 md:w-full md:m-auto md:mb-2 gap-0 md:gap-2 justify-center">
                                    <button class="btn relative btn-neutral -z-0 border-0 md:border" as="button">
                                        <div class="flex w-full gap-2 items-center justify-center"><svg
                                                stroke="currentColor" fill="none" stroke-width="1.5"
                                                viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                                                class="h-3 w-3 flex-shrink-0" height="1em" width="1em"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <polyline points="1 4 1 10 7 10"></polyline>
                                                <polyline points="23 20 23 14 17 14"></polyline>
                                                <path
                                                    d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15">
                                                </path>
                                            </svg>Regenerate response</div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{-- 入力エリア --}}
                        <div class="flex p-4 gap-4 text-base md:gap-6 md:max-w-2xl lg:max-w-[38rem] xl:max-w-3xl md:py-6 lg:px-0 m-auto">
                            <div
                                class="flex flex-col w-full py-[10px] flex-grow md:py-4 md:pl-4 relative border border-black/10 bg-white dark:border-gray-900/50 dark:text-white dark:bg-gray-700 rounded-xl shadow-xs dark:shadow-xs">
                                <textarea id="prompt-textarea" tabindex="0" data-id="request-:rbh:-0" rows="1" placeholder="Send a message."
                                    class="m-0 w-full resize-none border-0 bg-transparent p-0 pr-10 focus:ring-0 focus-visible:ring-0 dark:bg-transparent md:pr-12 pl-3 md:pl-0"
                                    style="max-height: 200px; height: 24px; overflow-y: hidden;"></textarea>
                                <button id="prompt-textarea-button"
                                    class="absolute p-1 rounded-md md:bottom-3 md:p-2 md:right-3 dark:hover:bg-gray-900 dark:disabled:hover:bg-transparent right-2 disabled:text-gray-400 enabled:bg-brand-purple text-white bottom-1.5 transition-colors disabled:opacity-40"
                                    {{-- style="" disabled="" --}}>
                                    <span class="" data-state="closed">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="none"
                                            class="h-4 w-4 m-1 md:m-0" stroke-width="2">
                                            <path
                                                d="M.5 1.163A1 1 0 0 1 1.97.28l12.868 6.837a1 1 0 0 1 0 1.766L1.969 15.72A1 1 0 0 1 .5 14.836V10.33a1 1 0 0 1 .816-.983L8.5 8 1.316 6.653A1 1 0 0 1 .5 5.67V1.163Z"
                                                fill="currentColor">
                                            </path>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        {{-- chatパラメータ --}}
        @include('main_thread/chat_option')
    </div>

    <script>

        window.addEventListener('load', () => {

            addEventToTextarea();

            // $chat_infos = [['chat_histories.id', 'parent_chat_history_id', 'role', 'content'], ...];
            @isset($chat_infos)
                const chat_of_user_div = document.querySelector('#origin-user > div');
                const chat_of_chat_gpt_div = document.querySelector('#origin-chat-gpt > div');
                let  chat_of_user_div_clone = null;
                let chat_of_chat_gpt_div_clone = null;
                @foreach ($chat_infos as $chat_info)
                    @switch($chat_info['role'])
                        @case('system')
                            document.querySelector('#system-prompt-area').hidden = true;
                        @case('user')
                            // chat_of_userを表示する.
                            chat_of_user_div_clone = chat_of_user_div.cloneNode(true);
                            chat_of_user_div_clone.querySelector('.js_text-of-user').textContent
                            = @json($chat_info['content']);
                            chat_of_user_div_clone.dataset.chatHistoryId = {{$chat_info['id']}};
                            document.querySelector('#threadArea').appendChild(chat_of_user_div_clone);
                            @break

                        @case('assistant')
                            // chat_of_chat_gptを表示する.
                            chat_of_chat_gpt_div_clone = chat_of_chat_gpt_div.cloneNode(true);
                            chat_of_chat_gpt_div_clone.querySelector('.js_text-of-chat-gpt').textContent
                            = @json($chat_info['content']);
                            chat_of_chat_gpt_div_clone.dataset.chatHistoryId = {{$chat_info['id']}};
                            document.querySelector('#threadArea').appendChild(chat_of_chat_gpt_div_clone);
                            @break
                        @default
                    @endswitch
                @endforeach
            @endisset
        });

        let chat_ulid = @json($chat_ulid);

        document.querySelector('#system-prompt-textarea-button').addEventListener('click', async () => {

            // Ajaxでsystem-promptを送る.(system-prompt保存).
            const user_prompt = document.querySelector('#system-prompt-textarea').value;
            const chat_history_id = await saveUserPrompt('system', user_prompt, null);
            document.querySelector('#system-prompt-area').hidden = true;

            // chat_of_userを表示する.
            const chat_of_user_div = document.querySelector('#origin-user > div');
            const chat_of_user_div_clone = chat_of_user_div.cloneNode(true);
            chat_of_user_div_clone.querySelector('.js_text-of-user').innerText = user_prompt;
            chat_of_user_div_clone.dataset.chatHistoryId = chat_history_id;
            document.querySelector('#threadArea').appendChild(chat_of_user_div_clone);
        });

        document.querySelector('#prompt-textarea-button').addEventListener('click', async () => {

            // Ajaxでpromptを送る.(prompt保存).
            const user_prompt = document.querySelector('#prompt-textarea').value;
            document.querySelector('#prompt-textarea').value = '';
            const parent_chat_history_id = getParentHistoryId('assistant');
            const options = getOptions();
            const chat_history_id = await saveUserPrompt('user', user_prompt, parent_chat_history_id, options);
            document.querySelector('#prompt-textarea').style.height = '24px';

            // chat_of_userを表示する.
            const chat_of_user_div = document.querySelector('#origin-user > div');
            const chat_of_user_div_clone = chat_of_user_div.cloneNode(true);
            chat_of_user_div_clone.querySelector('.js_text-of-user').innerText = user_prompt;
            chat_of_user_div_clone.dataset.chatHistoryId = chat_history_id;
            document.querySelector('#threadArea').appendChild(chat_of_user_div_clone);

            // chat_of_chat_gptを表示して,Ajax(EventSource)でChatGPTからのレスポンスを取得し表示していく.
            await getStreamResponseFromChatGPT()
        });

        /**
         * ユーザーのpromptを保存する.
        */
        const saveUserPrompt = async (role, user_prompt, parent_chat_history_id, options=null) => {
            return await fetch("{{ route('save_user_prompt') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': document.querySelector('#csrf-token').content,
                    },
                    body: JSON.stringify({role: role, prompt: user_prompt, chat_ulid: chat_ulid, parent_chat_history_id: parent_chat_history_id, options: options}),
                })
                .then((response) => response.json()) // レスポンスオブジェクトをJSONに変換
                .then((data) => {
                    chat_ulid = data.values.chat_ulid;
                    return data.values.chat_history_id;
                })
                .catch((error) => {
                    console.log('Error:', error);
                    return false;
                });
        }

        const deleteChat = async (chat_ulid) => {
            return await fetch("{{ route('delete_chat') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': document.querySelector('#csrf-token').content,
                    },
                    body: JSON.stringify({chat_ulid: chat_ulid}),
                })
                .then((response) => {
                    response.json()
                }) // レスポンスオブジェクトをJSONに変換
                .then((data) => {
                    location.href = "..";
                })
                .catch((error) => {
                    console.log('Error:', error);
                    return false;
                });
        }

        /**
         * ChatGPTのAPIを叩き、返答をストリームで受け取り逐次表示する.
        */
        const getStreamResponseFromChatGPT = () => {
            // chat_of_chat_gptを表示する.
            const chat_of_chat_gpt_div = document.querySelector('#origin-chat-gpt > div');
            const chat_of_chat_gpt_div_clone = chat_of_chat_gpt_div.cloneNode(true);
            document.querySelector('#threadArea').appendChild(chat_of_chat_gpt_div_clone);

            const parent_chat_history_id = getParentHistoryId('');
            console.log('イエス！」parent_chat_history_id', parent_chat_history_id);
            const eventSource = new EventSource(`{{ route('chat_gpt_stream_request') }}/${parent_chat_history_id}`);
            eventSource.onmessage =
                function(event) {
                    console.log('event', event)
                    const result_array = JSON.parse(event.data);
                    // どんどん文字列を追加していく.
                    if(!(result_array.content === '')) {
                        chat_of_chat_gpt_div_clone.querySelector('.js_text-of-chat-gpt').innerText += result_array.content;
                    }
                };

            eventSource.addEventListener('close', (event) => {
                console.log('close')
                eventSource.close();
            })

            eventSource.addEventListener('addChatHistoryId', (event) => {
                console.log('addChatHistoryId')
                eventSource.close();

                const chat_history_id = JSON.parse(event.data);
                console.log('chat_history_id', chat_history_id);
                chat_of_chat_gpt_div_clone.dataset.chatHistoryId = chat_history_id;
            })
        }

        /**
         *
        */
       const getParentHistoryId = (role) => {
            // 今後、roleの値が,user, assistantで取得するidを変える
            const chat_div_elems = document.querySelectorAll('.js_chat-content');

            let parent_chat_history_id = null;
            chat_div_elems.forEach((chat_div_elem) => {
                // ツリー上のhidden状態のdivは調査対象に含まない.
                if( !chat_div_elem.hidden ) {
                    if(chat_div_elem.dataset.chatHistoryId !== undefined)
                        parent_chat_history_id = chat_div_elem.dataset.chatHistoryId;
                }
            });
            return parent_chat_history_id ?? null;
        }

        const addEventToTextarea = () => {
            const textarea_elems = document.querySelectorAll('textarea');
            textarea_elems.forEach((textarea_elem) => {
                textarea_elem.addEventListener('input', () => {
                    textarea_elem.style.height = '24px';
                    //textareaの入力内容の高さを取得
                    let scrollHeight = textarea_elem.scrollHeight;
                    //textareaの高さに入力内容の高さを設定
                    textarea_elem.style.height = scrollHeight + 'px';

                    if(textarea_elem.style.height > textarea_elem.style.maxHeight)
                        textarea_elem.style.removeProperty('overflow-y');
                })
            })
        }

        /**chat_Option.blade.php
         * OptionのrangeSliderの値変更時に発火
         * 現在値を更新する
         */
        const updateOutput = (rangeInput) => {
            const output = document.getElementById(rangeInput.getAttribute('data-name') + "Output");
            output.value = rangeInput.value;
        }

        const getOptions = () => {
            const option_elems = document.querySelectorAll('#chatOptions input');
            console.log(option_elems);
            let returned_array = {};
            option_elems.forEach((option_elem) => {
                console.log('option_elem', option_elem);
                let option_name = option_elem.dataset.name;
                returned_array[option_name] =option_elem.value;
            })
            console.log('returned_array', returned_array)
            return returned_array
        }
    </script>
</body>
