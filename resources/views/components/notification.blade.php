<div
    x-data="{
        messages: [],
        add(message) {
            messageIndex = this.messages.push({ show: false, content: message }) - 1;

            setTimeout(() => { this.remove(messageIndex) }, 2500);
        },
        remove(messageIndex) {
            this.messages[messageIndex].show = false;

            setTimeout(() => { this.messages.splice(messageIndex, 1) }, 100);
        },
    }"
    aria-live="assertive"
    @notify.window="let message = $event.detail; add(message);"
    class="fixed inset-0 flex items-end px-4 py-6 pointer-events-none sm:p-6 z-20"
>
    <div class="w-full flex flex-col items-center space-y-4 sm:items-start">
        <template x-for="(message, messageIndex) in messages" :key="messageIndex" hidden>
            <div
                x-show="message.show"
                x-transition:enter="transform ease-out duration-300 transition"
                x-transition:enter-start="translate-y-2 opacity-0"
                x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                x-init="$nextTick(() => { message.show = true })"
                class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden"
            >
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <x-mito::icon.check-circle class="h-5 w-5 text-green-400" />
                        </div>
                        <div class="ml-3 w-0 flex-1">
                            <p x-text="message.content" class="text-sm font-medium text-gray-900"></p>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button @click="remove(messageIndex)" class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <span class="sr-only">Close</span>
                                <x-mito::icon.solid-x class="h-5 w-5" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
