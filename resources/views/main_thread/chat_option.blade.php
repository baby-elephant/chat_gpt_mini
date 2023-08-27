<div class="dark flex-shrink-0 overflow-x-hidden bg-gray-900" data-projection-id="165" style="width: 260px;">
    <div class="h-full w-[260px]">
        <div class="flex h-full min-h-0 flex-col ">
            <div class="scrollbar-trigger relative h-full w-full flex-1 items-start border-white/20">
                <h2
                    style="position: absolute; border: 0px; width: 1px; height: 1px; padding: 0px; margin: -1px; overflow: hidden; clip: rect(0px, 0px, 0px, 0px); white-space: nowrap; overflow-wrap: normal;">
                    Chat history
                </h2>
                <nav class="flex h-full w-full flex-col p-2" aria-label="Chat history">
                    <div class="flex-col flex-1 transition-opacity duration-500 overflow-y-auto -mr-2">
                        <div class="flex flex-col gap-2 pb-2 text-gray-100 text-sm">
                            <div><span>
                                    <div class="relative" data-projection-id="166"
                                        style="height: auto; opacity: 1;">
                                        <div class="sticky top-0 z-[16]" data-projection-id="167"
                                            style="opacity: 1;">
                                        </div>
                                        <ol id="chatOptions">
                                            <li>
                                              <p>temperature:<output for="temperature" id="temperatureOutput">1</output><br>
                                                0<input data-name="temperature" type="range" min="0" max="2" value="1" step="0.01" oninput="updateOutput(this);">2
                                                <br><span class="tooltip">0.8のような高い値は出力をよりランダムにし、0.2のような低い値は出力をより集中して決定論的にする。</span>
                                            </p>
                                            </li>
                                            <li>
                                              <p>n:<output for="n" id="nOutput">1</output><br>
                                                1<input data-name="n" type="range" min="1" max="5" value="1" step="1" oninput="updateOutput(this);">5
                                                <br><span class="tooltip">各入力メッセージに対していくつのチャット補完選択肢を生成するか。</span>
                                              </p>
                                            </li>
                                            <li>
                                              <p>max_tokens:<output for="max_tokens" id="max_tokensOutput">8000</output><br>
                                                10<input data-name="max_tokens" type="range" min="10" max="8000" value="8000" step="10" oninput="updateOutput(this);">8000
                                                <br><span class="tooltip">チャット完了時に生成するトークンの最大数。</span>
                                              </p>
                                            </li>
                                            <li>
                                              <p>presence_penalty:<output for="presence_penalty" id="presence_penaltyOutput">0</output><br>
                                                -2.0<input data-name="presence_penalty" type="range" min="-2.0" max="2" value="0" step="0.01" oninput="updateOutput(this);">2.0
                                                <br><span class="tooltip">正の値は、新しいトークンがこれまでにテキストに現れたかどうかに基づいてペナルティを課し、モデルが新しいトピックについて話す可能性を高める。</span>
                                              </p>
                                            </li>
                                            <li>
                                              <p>frequency_penalty:<output for="frequency_penalty" id="frequency_penaltyOutput">0</output><br>
                                                -2.0<input data-name="frequency_penalty" type="range" min="-2.0" max="2" value="0" step="0.01" oninput="updateOutput(this);">2.0
                                                <br><span class="tooltip">正の値は、新しいトークンに、これまでのテキストでの頻度に基づいてペナルティを与え、モデルが同じ行を逐語的に繰り返す可能性を減らします。</span>
                                              </p>
                                            </li>
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
