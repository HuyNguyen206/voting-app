<x-app-layout>
    <a href="{{$url}}" class="font-semibold flex"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
        </svg><span>All ideas</span></a>
    <livewire:idea-show :idea="$idea"/>
    @can('update', $idea)
    <livewire:edit-idea :idea="$idea"/>
    @endcan

    @can('delete', $idea)
    <livewire:delete-idea :idea="$idea"/>
    @endcan
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
                    <ul @click.outside.window="showDialog = false" x-show="showDialog" x-transition class="space-y-4 lg:left-0 right-0 top-9 absolute w-44 font-semibold bg-white shadow-lg rounded-xl py-3">
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
