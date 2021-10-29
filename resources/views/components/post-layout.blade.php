<div class="relative h-screen overflow-hidden bg-gray-100 flex flex-col">
    <!-- Top nav-->
    {{ $header }}

    <!-- Bottom section -->
    <div class="min-h-0 flex-1 flex overflow-hidden">
        <!-- Main area -->
        <main class="min-w-0 flex-1 border-t border-gray-200 xl:flex">
            <section class="min-w-0 flex-1 h-full flex flex-col overflow-hidden xl:order-last">
                {{ $centerColumn }}
            </section>

            <aside class="hidden xl:block xl:flex-shrink-0 xl:order-last">
                <div class="h-full relative flex flex-col w-96 border-l border-gray-200 bg-white">
                    {{ $rightColumn }}
                </div>
            </aside>

            <aside class="hidden xl:block xl:flex-shrink-0 xl:order-first">
                <div class="h-full relative flex flex-col w-72 border-r border-gray-200 bg-white">
                    {{ $leftColumn }}
                </div>
            </aside>
        </main>
    </div>

    <x-mito::notification />
</div>
