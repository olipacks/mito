<div class="relative h-screen overflow-hidden bg-gray-100 flex flex-col">
    <div class="min-h-0 flex-1 flex overflow-hidden">
        <main class="min-w-0 flex-1 md:flex">
            <aside class="flex-shrink-0 h-full flex flex-col overflow-hidden order-first">
                <div class="h-full relative flex flex-col w-full md:w-72 border-r border-gray-200 bg-white">
                    {{ $leftColumn }}
                </div>
            </aside>

            <section class="hidden md:block min-w-0 flex-1 h-full flex flex-col overflow-hidden md:order-last">
                {{ $rightColumn }}
            </section>
        </main>
    </div>

    <x-mito::notification />
</div>
