<div class="dark flex-shrink-0 overflow-x-hidden bg-gray-900" data-projection-id="165" style="width: 260px;">
    <div class="h-full w-[260px]">
        <div class="flex h-full min-h-0 flex-col ">
            <div class="scrollbar-trigger relative h-full w-full flex-1 items-start border-white/20">
                <h2
                    style="position: absolute; border: 0px; width: 1px; height: 1px; padding: 0px; margin: -1px; overflow: hidden; clip: rect(0px, 0px, 0px, 0px); white-space: nowrap; overflow-wrap: normal;">
                    Chat history
                </h2>
                <nav class="flex h-full w-full flex-col p-2" aria-label="Chat history">
                    <div class="mb-1 flex flex-row gap-2"><a
                            href="{{route('view_main_thread_new')}}"
                            class="flex p-3 items-center gap-3 transition-colors duration-200 text-white cursor-pointer text-sm rounded-md border border-white/20 hover:bg-gray-500/10 h-11 flex-shrink-0 flex-grow"><svg
                                stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"
                                stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em"
                                width="1em" xmlns="http://www.w3.org/2000/svg">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>New chat</a><span class="" data-state="closed"><a
                                class="flex p-3 gap-3 transition-colors duration-200 text-white cursor-pointer text-sm rounded-md border border-white/20 hover:bg-gray-500/10 h-11 w-11 flex-shrink-0 items-center justify-center"><svg
                                    stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"
                                    stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"
                                    height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="3" width="18" height="18"
                                        rx="2" ry="2"></rect>
                                    <line x1="9" y1="3" x2="9" y2="21"></line>
                                </svg><span
                                    style="position: absolute; border: 0px; width: 1px; height: 1px; padding: 0px; margin: -1px; overflow: hidden; clip: rect(0px, 0px, 0px, 0px); white-space: nowrap; overflow-wrap: normal;">Hide
                                    sidebar</span></a></span></div>
                    <div class="absolute left-0 top-14 z-20 overflow-hidden transition-all duration-500 invisible max-h-0">
                        <div class="bg-gray-900 px-4 py-3">
                            <div class="p-1 text-sm text-gray-100">Chat History is off for this browser.</div>
                            <div class="p-1 text-xs text-gray-500">When history is turned off, new chats on this
                                browser won't appear in your history on any of your devices, be used to train
                                our
                                models, or stored for longer than 30 days. <strong>This setting does not sync
                                    across
                                    browsers or devices.</strong> <a
                                    href="" target="_blank"
                                    class="underline" rel="noreferrer">Learn more</a></div><button
                                class="btn relative btn-primary mt-4 w-full">
                                <div class="flex w-full gap-2 items-center justify-center"><svg
                                        stroke="currentColor" fill="none" stroke-width="2"
                                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"
                                        class="h-4 w-4" height="1em" width="1em"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path>
                                        <line x1="12" y1="2" x2="12" y2="12">
                                        </line>
                                    </svg>Enable chat history</div>
                            </button>
                        </div>
                        <div class="h-24 bg-gradient-to-t from-gray-900/0 to-gray-900"></div>
                    </div>
                    <div class="flex-col flex-1 transition-opacity duration-500 overflow-y-auto -mr-2">
                        <div class="flex flex-col gap-2 pb-2 text-gray-100 text-sm">
                            <div><span>
                                    <div class="relative" data-projection-id="166"
                                        style="height: auto; opacity: 1;">
                                        <div class="sticky top-0 z-[16]" data-projection-id="167"
                                            style="opacity: 1;">
                                            <h3
                                                class="h-9 pb-2 pt-3 px-3 text-xs text-gray-500 font-medium text-ellipsis overflow-hidden break-all bg-gray-900">
                                                Today</h3>
                                        </div>
                                        <ol>
                                            @isset($chat_history_infos)
                                                @foreach ($chat_history_infos as $chat_history_info)
                                                    <li
                                                        id="chat_ulid{{$chat_history_info['ulid']}}"
                                                        class="relative z-[15]" data-projection-id="200"
                                                        style="opacity: 1; height: auto; overflow: hidden;">
                                                        <a href="{{route('view_main_thread', ['chat_ulid' => $chat_history_info['ulid']])}}" class="flex py-3 px-3 items-center gap-3 relative rounded-md cursor-pointer break-all pr-[4.5rem] )} )} bg-gray-800 hover:bg-gray-800 group">
                                                            <svg
                                                                stroke="currentColor" fill="none" stroke-width="2"
                                                                viewBox="0 0 24 24" stroke-linecap="round"
                                                                stroke-linejoin="round" class="h-4 w-4" height="1em"
                                                                width="1em" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z">
                                                                </path>
                                                            </svg>
                                                            <div class="js_chat-title flex-1 text-ellipsis max-h-5 overflow-hidden break-all relative">
                                                                {{-- chats-table's title column  --}}
                                                                {{$chat_history_info['title']}}
                                                                {{-- <div class="absolute inset-y-0 right-0 w-8 z-10 bg-gradient-to-l from-gray-800">
                                                                </div> --}}
                                                            </div>
                                                            <div
                                                                class="absolute flex right-1 z-10 text-gray-300 visible">
                                                                <button
                                                                    onclick="editChatTitle('{{$chat_history_info['ulid']}}')"
                                                                    type="button"
                                                                    class="p-1 hover:text-white"><svg
                                                                    stroke="currentColor" fill="none"
                                                                    stroke-width="2" viewBox="0 0 24 24"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="h-4 w-4" height="1em" width="1em"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M12 20h9"></path>
                                                                    <path
                                                                        d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z">
                                                                    </path>
                                                                </svg></button>
                                                                {{-- <button type="button"
                                                                    aria-haspopup="dialog" aria-expanded="false"
                                                                    aria-controls="radix-:rbv:" data-state="closed"
                                                                    class="p-1 hover:text-white"><svg
                                                                    stroke="currentColor" fill="none"
                                                                    stroke-width="2" viewBox="0 0 24 24"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="h-4 w-4" height="1em" width="1em"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8">
                                                                    </path>
                                                                    <polyline points="16 6 12 2 8 6"></polyline>
                                                                    <line x1="12" y1="2"
                                                                        x2="12" y2="15"></line>
                                                                </svg></button> --}}
                                                                <button
                                                                    onclick="deleteChat('{{$chat_history_info['ulid']}}')"
                                                                    type="button"
                                                                    class="p-1 hover:text-white"><svg
                                                                    stroke="currentColor" fill="none"
                                                                    stroke-width="2" viewBox="0 0 24 24"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="h-4 w-4" height="1em" width="1em"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                                    <path
                                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                    </path>
                                                                    <line x1="10" y1="11"
                                                                        x2="10" y2="17"></line>
                                                                    <line x1="14" y1="11"
                                                                        x2="14" y2="17"></line>
                                                                </svg></button>
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endisset
                                        </ol>
                                    </div>
                                </span><span></span><span></span></div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
