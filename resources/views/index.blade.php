<x-app-layout>
    <div class="filters flex space-x-6">
        <div class="w-1/3">
            <select name="category" id="" class="border-none w-full rounded-xl px-4 px-2">
                <option value="">Op1</option>
                <option value="">Op2</option>
                <option value="">Op3</option>
            </select>
        </div>
        <div class="w-1/3">
            <select name="other_filter" id="" class="border-none w-full rounded-xl px-4 px-2">
                <option value="">Op1</option>
                <option value="">Op2</option>
                <option value="">Op3</option>
            </select>
        </div>
        <div class="w-2/3 relative">
            <input type="search" placeholder="Find an idea"
                   class="w-full rounded-xl bg-white px-4 py-2 pl-8 border-none">
            <div class="absolute top-0 flex items-center h-full ml-2">
                <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>
    </div>
    <div class="ideas-container  duration-150 space-y-6 my-6">
        <div class="idea-container cursor-pointer hover:shadow-md transition bg-white rounded-xl">
            <div class="flex">
                <div class="border-r border-gray-100 px-5 py-8">
                    <div class="text-center">
                        <div class="font-semibold text-2xl">12</div>
                        <div class="text-gray-500">Votes</div>
                    </div>
                    <div class=" mt-8">
                        <button
                            class="border-gray-200 hover:border-gray-400 w-20 hover:bg-blue transition duration-150 text-xxs hover:text-white px-4 text-md py-2 rounded-xl bg-gray-300 uppercase">
                            Vote
                        </button>
                    </div>
                </div>
                <div class="ml-4 flex px-5 py-8">
                    <a href="" class="flex-none">
                        <img src="{{asset('images/avatar.png')}}" class="w-14 h-14 rounded-xl mr-4" alt="">
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

            <div class="flex justify-between  px-5 py-8">
                <div class="flex items-center space-x-6">
                    <span class="text-gray-400">10 hour ago</span>
                    <span class="text-2xl text-gray-300">&bull;</span>
                    <span class="text-gray-400">Category</span>
                    <span class="text-2xl text-gray-300">&bull;</span>
                    <span class="font-semibold">3 Comments</span>
                </div>
                <div class="flex space-x-6">
                    <button class="px-6 py-2 font-semibold uppercase rounded-xl bg-gray-300">open</button>
                    <button
                        class="relative flex items-center px-6 py-2 font-semibold uppercase rounded-xl text-gray-400 bg-gray-300">
                    <span><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                               stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round"
        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
</svg></span>
                        <ul class="space-y-4 top-9 absolute w-44 font-semibold bg-white shadow-lg rounded-xl py-3">
                            <li class="text-left hover:bg-gray-100 transition font-semibold duration-150 py-2"><a href="" class="px-5 py-3 font-bold">Mark as spam</a></li>
                            <li class="text-left hover:bg-gray-100 transition font-semibold duration-150 py-2"><a href="" class="px-5 py-3 font-bold">Delete post</a></li>
                        </ul>
                    </button>
                </div>
            </div>
        </div>
        <div class="idea-container cursor-pointer hover:shadow-md transition bg-white rounded-xl">
            <div class="flex">
                <div class="border-r border-gray-100 px-5 py-8">
                    <div class="text-center">
                        <div class="font-semibold text-2xl text-blue">12</div>
                        <div class="text-gray-500">Votes</div>
                    </div>
                    <div class=" mt-8">
                        <button
                            class="border-gray-200 hover:border-gray-400 w-20 hover:bg-blue transition duration-150 text-xxs hover:text-white px-4 text-md py-2 rounded-xl bg-gray-300 uppercase">
                            Vote
                        </button>
                    </div>
                </div>
                <div class="ml-4 flex px-5 py-8">
                    <a href="" class="flex-none">
                        <img src="{{asset('images/avatar.png')}}" class="w-14 h-14 rounded-xl mr-4" alt="">
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

            <div class="flex justify-between  px-5 py-8">
                <div class="flex items-center space-x-4">
                    <span class="text-gray-400">10 hour ago</span>
                    <span class="text-2xl text-gray-300">&bull;</span>
                    <span class="text-gray-400">Category</span>
                    <span class="text-2xl text-gray-300">&bull;</span>
                    <span class="font-semibold">3 Comments</span>
                </div>
                <div class="flex space-x-6">
                    <button class="px-6 py-2 font-semibold uppercase rounded-xl bg-yellow-300 text-white">in progress</button>
                    <button
                        class="relative flex items-center px-6 py-2 font-semibold uppercase rounded-xl text-gray-400 bg-gray-300">
                    <span><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                               stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round"
        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
</svg></span>
                        <ul class="space-y-4 top-9 absolute w-44 font-semibold bg-white shadow-lg rounded-xl py-3">
                            <li class="text-left hover:bg-gray-100 transition font-semibold duration-150 py-2"><a href="" class="px-5 py-3 font-bold">Mark as spam</a></li>
                            <li class="text-left hover:bg-gray-100 transition font-semibold duration-150 py-2"><a href="" class="px-5 py-3 font-bold">Delete post</a></li>
                        </ul>
                    </button>
                </div>
            </div>
        </div>
        <div class="idea-container cursor-pointer hover:shadow-md transition bg-white rounded-xl">
            <div class="flex">
                <div class="border-r border-gray-100 px-5 py-8">
                    <div class="text-center">
                        <div class="font-semibold text-2xl">12</div>
                        <div class="text-gray-500">Votes</div>
                    </div>
                    <div class=" mt-8">
                        <button
                            class="border-gray-200 hover:border-gray-400 w-20 hover:bg-blue transition duration-150 text-xxs hover:text-white px-4 text-md py-2 rounded-xl bg-gray-300 uppercase">
                            Vote
                        </button>
                    </div>
                </div>
                <div class="ml-4 flex px-5 py-8">
                    <a href="" class="flex-none">
                        <img src="{{asset('images/avatar.png')}}" class="w-14 h-14 rounded-xl mr-4" alt="">
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

            <div class="flex justify-between  px-5 py-8">
                <div class="flex items-center space-x-6">
                    <span class="text-gray-400">10 hour ago</span>
                    <span class="text-2xl text-gray-300">&bull;</span>
                    <span class="text-gray-400">Category</span>
                    <span class="text-2xl text-gray-300">&bull;</span>
                    <span class="font-semibold">3 Comments</span>
                </div>
                <div class="flex space-x-6">
                    <button class="px-6 py-2 font-semibold uppercase rounded-xl bg-gray-300">open</button>
                    <button
                        class="relative flex items-center px-6 py-2 font-semibold uppercase rounded-xl text-gray-400 bg-gray-300">
                    <span><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                               stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round"
        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
</svg></span>
                        <ul class="space-y-4 top-9 absolute w-44 font-semibold bg-white shadow-lg rounded-xl py-3">
                            <li class="text-left hover:bg-gray-100 transition font-semibold duration-150 py-2"><a href="" class="px-5 py-3 font-bold">Mark as spam</a></li>
                            <li class="text-left hover:bg-gray-100 transition font-semibold duration-150 py-2"><a href="" class="px-5 py-3 font-bold">Delete post</a></li>
                        </ul>
                    </button>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
