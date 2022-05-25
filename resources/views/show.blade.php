<x-app-layout>
    <a href="/" class="font-semibold flex"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
        </svg><span>All ideas</span></a>
    <div class="idea-container cursor-pointer hover:shadow-md transition bg-white rounded-xl">
        <div class="flex">
{{--            <div class="border-r border-gray-100 px-5 py-8">--}}
{{--                <div class="text-center">--}}
{{--                    <div class="font-semibold text-2xl">12</div>--}}
{{--                    <div class="text-gray-500">Votes</div>--}}
{{--                </div>--}}
{{--                <div class=" mt-8">--}}
{{--                    <button class="border-gray-200 hover:border-gray-400 w-20 hover:bg-blue transition duration-150 text-xxs hover:text-white px-4 text-md py-2 rounded-xl bg-gray-300 uppercase">--}}
{{--                        Vote--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="ml-4 flex px-5 py-8">
                <a href="" class="flex-none">
                    <img src="http://voting-app-local.test/images/avatar.png" class="w-14 h-14 rounded-xl mr-4" alt="">
                </a>
                <div>
                    <h4 class="mb-4 font-semibold text-xl">
                        <a href="">A random title</a></h4>
                    <p class="line-clamp-3">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid at, aut distinctio ducimus non
                        omnis perspiciatis quaerat quasi tempore! Accusamus alias assumenda at debitis delectus deserunt
                        dolorem excepturi facilis fugiat illum incidunt labore laborum molestias neque officiis, placeat
                        quaerat quas recusandae repellat rerum totam veritatis voluptas? Ad laudantium quasi sed! Ad,
                        adipisci atque esse eum harum labore maiores necessitatibus nemo nisi odio praesentium
                        reiciendis repellat, saepe tempora vel! Consequatur cum doloremque harum, obcaecati pariatur
                        possimus praesentium repudiandae velit voluptates! Accusantium ad consequatur eos, illo non
                        repellendus! Aliquam animi commodi culpa doloremque est et exercitationem illo labore maiores
                        molestias natus numquam odio odit, perferendis perspiciatis placeat quae quaerat quia quibusdam
                        quidem quisquam quo quos reiciendis reprehenderit rerum saepe voluptatem? Ad esse iusto
                        molestiae natus quaerat quia rem sequi sit suscipit vel! Ab blanditiis dicta eveniet facilis
                        harum hic id in laborum magnam, molestias mollitia perferendis praesentium quos rem saepe sit
                        voluptatum. Asperiores at, consectetur harum necessitatibus officia sint. Debitis dignissimos
                        distinctio modi numquam rerum! Accusantium aliquid consequatur consequuntur corporis cupiditate
                        delectus deleniti dicta distinctio ducimus ea earum eius esse fuga harum impedit iure magnam
                        molestiae molestias nam natus nemo omnis pariatur, perspiciatis placeat possimus, quasi quis
                        reiciendis rerum saepe sit velit?
                    </p>
                </div>

            </div>

        </div>

        <div class="flex justify-between items-center  px-5 py-8">
            <div class="flex items-center text-xs space-x-4 ml-4 flex px-5 py-8">
                <span class="font-semibold">Joe Doe</span>
                <span class="text-2xl text-gray-300">•</span>
                <span class="text-gray-400">10 hour ago</span>
                <span class="text-2xl text-gray-300">•</span>
                <span class="text-gray-400">Category</span>
                <span class="text-2xl text-gray-300">•</span>
                <span class="font-semibold">3 Comments</span>
            </div>
            <div class="flex space-x-6" x-data="{showDialog:false}">
                <button class="px-6 py-2 font-semibold uppercase rounded-xl bg-gray-300">open</button>
                <button @click="showDialog = !showDialog"
                        class="relative flex items-center px-6 py-2 font-semibold uppercase rounded-xl text-gray-400 bg-gray-300">
                    <span><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                               stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round"
        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
</svg></span>
                    <ul @click.outside.window="showDialog = false" x-show="showDialog" x-transition class="space-y-4 top-9 absolute w-44 font-semibold bg-white shadow-lg rounded-xl py-3">
                        <li class="text-left hover:bg-gray-100 transition font-semibold duration-150 py-2"><a href="" class="px-5 py-3 font-bold">Mark as spam</a></li>
                        <li class="text-left hover:bg-gray-100 transition font-semibold duration-150 py-2"><a href="" class="px-5 py-3 font-bold">Delete post</a></li>
                    </ul>
                </button>
            </div>
        </div>
    </div>
    <div class="flex justify-between">
        <div class="flex justify-start items-center">
           <div class="relative" x-data="{showReply : false}">
               <button @click="showReply = !showReply" class="mr-2 px-8 h-10 placeholder-gray-700 bg-gray-100 rounded-xl bg-blue text-white">Reply</button>
               <div x-cloak x-show="showReply" @click.outside.window="showReply = false" x-transition class="absolute w-160 bg-white rounded-xl text-sm z-10 px-2 py-4 shadow-md">
                   <form class="px-2 py-4" action="">
                       <textarea class="border-none w-full rounded-xl bg-gray-200" placeholder="Go ahead, don't be shy. Share your thought..." cols="30" rows="4"></textarea>
                       <div class="flex space-x-4 mt-2">
                           <button class="bg-blue text-white px-4 py-2 rounded-xl">Post Comment</button>
                           <div class="flex items-center justify-between">
                               <input type="file" name="" style="display: none" id="attachFile">
                               <label for="attachFile" class="flex items-center cursor-pointer px-6 py-4 bg-gray-100 rounded-xl"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                       <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                   </svg><span>Attach</span></label>
                           </div>
                       </div>

                   </form>
               </div>
           </div>
            <div class="relative" x-data="{showStatus: false}">
                <button @click="showStatus = !showStatus"  placeholder="Set status" class="w-32 px-2 px-8 h-10 text-gray-500  bg-gray-300 rounded-xl border-none" name="" id="">Set status</button>
                <div @keydown.esc.window="showStatus = false" x-cloak @click.outside.window="showStatus = false" x-show="showStatus" x-transition class="absolute w-80 bg-white rounded-xl text-sm z-10 px-2 py-4 shadow-md">
                    <form class="px-2 py-4" action="">
                        <div class="mt-2">
                            <div>
                                <label class="inline-flex items-center">
                                    <input class="form-radio" type="radio" checked="" name="radio-direct" value="1">
                                    <span class="ml-2">Open</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input class="form-radio" type="radio" name="radio-direct" value="2">
                                    <span class="ml-2">Considering</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input class="form-radio" type="radio" name="radio-direct" value="3">
                                    <span class="ml-2">In progress</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input class="form-radio" type="radio" name="radio-direct" value="3">
                                    <span class="ml-2">In progress</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input class="form-radio" type="radio" name="radio-direct" value="3">
                                    <span class="ml-2">In progress</span>
                                </label>
                            </div>
                        </div>
                        <textarea class="placeholder-gray-500 mt-2 border-none w-full rounded-xl bg-gray-200" placeholder="Go ahead, don't be shy. Share your thought..." cols="30" rows="4"></textarea>
                        <div class="flex space-x-4 mt-2">
                            <button class="bg-blue text-white px-4 py-2 rounded-xl">Update</button>
                            <div class="flex items-center justify-between">
                                <input type="file" name="" style="display: none" id="attachFileComment">
                                <label for="attachFileComment" class="flex items-center cursor-pointer px-6 py-4 bg-gray-100 rounded-xl"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                    </svg><span>Attach</span></label>
                            </div>

                        </div>
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input class="form-checkbox" type="checkbox" checked="">
                                <span class="ml-2">Notify all users</span>
                            </label>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="flex justify-end items-center border-r border-gray-100 px-5 py-8">
            <div class="text-center mr-2">
                <div class="font-semibold text-2xl">12</div>
                <div class="text-gray-500">Votes</div>
            </div>
            <div>
                <button
                    class="px-8 h-10 border-gray-200 hover:border-gray-400 hover:bg-blue transition duration-150 hover:text-white px-4 text-md py-2 rounded-xl bg-gray-300 uppercase">
                    Vote
                </button>
            </div>
        </div>
    </div>
<div class="comments-container relative space-y-4">
    <div class="comment relative">
        <div class="flex">
            <div class="ml-4 flex px-5 py-8">
                <a href="" class="flex-none">
                    <img src="http://voting-app-local.test/images/avatar.png" class="w-14 h-14 rounded-xl mr-4" alt="">
                </a>
                <div>
                    <p class="line-clamp-3">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid at, aut distinctio ducimus non
                        omnis perspiciatis quaerat quasi tempore! Accusamus alias assumenda at debitis delectus deserunt
                        dolorem excepturi facilis fugiat illum incidunt labore laborum molestias neque officiis, placeat
                        quaerat quas recusandae repellat rerum totam veritatis voluptas? Ad laudantium quasi sed! Ad,
                        adipisci atque esse eum harum labore maiores necessitatibus nemo nisi odio praesentium
                        reiciendis repellat, saepe tempora vel! Consequatur cum doloremque harum, obcaecati pariatur
                        possimus praesentium repudiandae velit voluptates! Accusantium ad consequatur eos, illo non
                        repellendus! Aliquam animi commodi culpa doloremque est et exercitationem illo labore maiores
                        molestias natus numquam odio odit, perferendis perspiciatis placeat quae quaerat quia quibusdam
                        quidem quisquam quo quos reiciendis reprehenderit rerum saepe voluptatem? Ad esse iusto
                        molestiae natus quaerat quia rem sequi sit suscipit vel! Ab blanditiis dicta eveniet facilis
                        harum hic id in laborum magnam, molestias mollitia perferendis praesentium quos rem saepe sit
                        voluptatum. Asperiores at, consectetur harum necessitatibus officia sint. Debitis dignissimos
                        distinctio modi numquam rerum! Accusantium aliquid consequatur consequuntur corporis cupiditate
                        delectus deleniti dicta distinctio ducimus ea earum eius esse fuga harum impedit iure magnam
                        molestiae molestias nam natus nemo omnis pariatur, perspiciatis placeat possimus, quasi quis
                        reiciendis rerum saepe sit velit?
                    </p>
                </div>

            </div>

        </div>

        <div class="flex justify-between items-center  px-5 py-2">
            <div class="flex items-center text-xs space-x-4 ml-4 flex px-5 py-4">
                <span class="font-semibold">Joe Doe</span>
                <span class="text-2xl text-gray-300">•</span>
                <span class="text-gray-400">10 hour ago</span>
            </div>
            <div class="flex space-x-6" x-data="{showDialog:false}">
                <button @click="showDialog = !showDialog"
                        class="relative flex items-center px-6 py-2 font-semibold uppercase rounded-xl text-gray-400 bg-gray-300">
                    <span><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                               stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round"
        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
</svg></span>
                    <ul @click.outside.window="showDialog = false" x-show="showDialog" x-transition class="space-y-4 top-9 absolute w-44 font-semibold bg-white shadow-lg rounded-xl py-3">
                        <li class="text-left hover:bg-gray-100 transition font-semibold duration-150 py-2"><a href="" class="px-5 py-3 font-bold">Mark as spam</a></li>
                        <li class="text-left hover:bg-gray-100 transition font-semibold duration-150 py-2"><a href="" class="px-5 py-3 font-bold">Delete post</a></li>
                    </ul>
                </button>
            </div>
        </div>
    </div>
    <div class="comment is-admin border-blue border-2 rounded-xl">
        <div class="flex">
            <div class="ml-4 flex px-5 py-2">
                <div class="flex-none text-center">
                    <a href="">
                        <img src="http://voting-app-local.test/images/avatar.png" class="w-14 h-14 rounded-xl" alt="">
                    </a>
                    <p class="text-blue uppercase text-center">Admin</p>
                </div>

                <div class="ml-2">
                    <h4 class="uppercase font-semibold text-xl">Change by admin</h4>
                    <p class="line-clamp-3">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid at, aut distinctio ducimus non
                        omnis perspiciatis quaerat quasi tempore! Accusamus alias assumenda at debitis delectus deserunt
                        dolorem excepturi facilis fugiat illum incidunt labore laborum molestias neque officiis, placeat
                        quaerat quas recusandae repellat rerum totam veritatis voluptas? Ad laudantium quasi sed! Ad,
                        adipisci atque esse eum harum labore maiores necessitatibus nemo nisi odio praesentium
                        reiciendis repellat, saepe tempora vel! Consequatur cum doloremque harum, obcaecati pariatur
                        possimus praesentium repudiandae velit voluptates! Accusantium ad consequatur eos, illo non
                        repellendus! Aliquam animi commodi culpa doloremque est et exercitationem illo labore maiores
                        molestias natus numquam odio odit, perferendis perspiciatis placeat quae quaerat quia quibusdam
                        quidem quisquam quo quos reiciendis reprehenderit rerum saepe voluptatem? Ad esse iusto
                        molestiae natus quaerat quia rem sequi sit suscipit vel! Ab blanditiis dicta eveniet facilis
                        harum hic id in laborum magnam, molestias mollitia perferendis praesentium quos rem saepe sit
                        voluptatum. Asperiores at, consectetur harum necessitatibus officia sint. Debitis dignissimos
                        distinctio modi numquam rerum! Accusantium aliquid consequatur consequuntur corporis cupiditate
                        delectus deleniti dicta distinctio ducimus ea earum eius esse fuga harum impedit iure magnam
                        molestiae molestias nam natus nemo omnis pariatur, perspiciatis placeat possimus, quasi quis
                        reiciendis rerum saepe sit velit?
                    </p>
                </div>

            </div>

        </div>

        <div class="flex justify-between items-center  px-5 py-2">
            <div class="flex items-center text-xs space-x-4 ml-4 flex px-5 py-4">
                <span class="font-semibold text-blue">Joe Doe</span>
                <span class="text-2xl text-gray-300">•</span>
                <span class="text-gray-400">10 hour ago</span>
            </div>
            <div class="flex space-x-6">
                <button class="relative flex items-center px-8 h-8 font-semibold uppercase rounded-xl text-gray-400 bg-gray-300">
                    <span><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
</svg></span>
                </button>
            </div>
        </div>
    </div>
    <div class="comment">
        <div class="flex">
            <div class="ml-4 flex px-5 py-8">
                <a href="" class="flex-none">
                    <img src="http://voting-app-local.test/images/avatar.png" class="w-14 h-14 rounded-xl mr-4" alt="">
                </a>
                <div>
                    <p class="line-clamp-3">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid at, aut distinctio ducimus non
                        omnis perspiciatis quaerat quasi tempore! Accusamus alias assumenda at debitis delectus deserunt
                        dolorem excepturi facilis fugiat illum incidunt labore laborum molestias neque officiis, placeat
                        quaerat quas recusandae repellat rerum totam veritatis voluptas? Ad laudantium quasi sed! Ad,
                        adipisci atque esse eum harum labore maiores necessitatibus nemo nisi odio praesentium
                        reiciendis repellat, saepe tempora vel! Consequatur cum doloremque harum, obcaecati pariatur
                        possimus praesentium repudiandae velit voluptates! Accusantium ad consequatur eos, illo non
                        repellendus! Aliquam animi commodi culpa doloremque est et exercitationem illo labore maiores
                        molestias natus numquam odio odit, perferendis perspiciatis placeat quae quaerat quia quibusdam
                        quidem quisquam quo quos reiciendis reprehenderit rerum saepe voluptatem? Ad esse iusto
                        molestiae natus quaerat quia rem sequi sit suscipit vel! Ab blanditiis dicta eveniet facilis
                        harum hic id in laborum magnam, molestias mollitia perferendis praesentium quos rem saepe sit
                        voluptatum. Asperiores at, consectetur harum necessitatibus officia sint. Debitis dignissimos
                        distinctio modi numquam rerum! Accusantium aliquid consequatur consequuntur corporis cupiditate
                        delectus deleniti dicta distinctio ducimus ea earum eius esse fuga harum impedit iure magnam
                        molestiae molestias nam natus nemo omnis pariatur, perspiciatis placeat possimus, quasi quis
                        reiciendis rerum saepe sit velit?
                    </p>
                </div>

            </div>

        </div>

        <div class="flex justify-between items-center  px-5 py-2">
            <div class="flex items-center text-xs space-x-4 ml-4 flex px-5 py-4">
                <span class="font-semibold">Joe Doe</span>
                <span class="text-2xl text-gray-300">•</span>
                <span class="text-gray-400">10 hour ago</span>
            </div>
            <div class="flex space-x-6">
                <button class="relative flex items-center px-8 h-8 font-semibold uppercase rounded-xl text-gray-400 bg-gray-300">
                    <span><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
</svg></span>
                </button>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
