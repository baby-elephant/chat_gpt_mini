{{-- ユーザーメッセージ --}}
<div id="origin-user" hidden>
    <div class="js_chat-of-user js_chat-content group w-full text-gray-800 dark:text-gray-100 border-b border-black/10 dark:border-gray-900/50 dark:bg-gray-800">
        <div class="flex p-4 gap-4 text-base md:gap-6 md:max-w-2xl lg:max-w-[38rem] xl:max-w-3xl md:py-6 lg:px-0 m-auto">
            <div class="relative flex w-[calc(100%-50px)] flex-col gap-1 md:gap-3 lg:w-[calc(100%-115px)]">
                <div class="flex flex-grow flex-col gap-3">
                    <div class="js_text-of-user min-h-[20px] flex flex-col items-start gap-4 whitespace-pre-wrap break-words">{{-- ここにメッセージを挿入する --}}</div>
                </div>
                <div class="text-gray-400 flex self-end lg:self-center justify-center mt-2 gap-2 md:gap-3 lg:gap-1 lg:absolute lg:top-0 lg:translate-x-full lg:right-0 lg:mt-0 lg:pl-2 visible">
                    <button
                        class="p-1 rounded-md hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200 disabled:dark:hover:text-gray-400 md:invisible md:group-hover:visible"><svg
                            stroke="currentColor" fill="none" stroke-width="2"
                            viewBox="0 0 24 24" stroke-linecap="round"
                            stroke-linejoin="round" class="h-4 w-4" height="1em"
                            width="1em" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                            </path>
                            <path
                                d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                            </path>
                        </svg></button>
                </div>
                <div class="flex justify-between lg:block"></div>
            </div>
        </div>
    </div>
</div>
