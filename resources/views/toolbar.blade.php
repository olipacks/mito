<x-mito::html>
    <div class="max-w-lg mx-auto py-20" x-data>
        <markdown-toolbar class="flex space-x-2" for="textarea_id">
          <md-bold x-ref="bold" class="border rounded-sm px-2.5 py-1 text-sm" data-tippy-content="Add bold text <cmd-b>" data-tippy-delay="[300, 0]">
            <span class="sr-only">bold</span> <x-mito::icon.bold class="w-5 h-5 text-gray-400" />
          </md-bold>
          <md-italic x-ref="italic" class="border rounded-sm px-2.5 py-1 text-sm" data-tippy-content="Add italic text <cmd-i>" data-tippy-delay="[300, 0]">
            <span class="sr-only">italic</span> <x-mito::icon.italic class="w-5 h-5 text-gray-400" />
          </md-italic>
          <md-quote x-ref="quote" class="border rounded-sm px-2.5 py-1 text-sm" data-tippy-content="Insert a quote <cmd-shift-.>" data-tippy-delay="[300, 0]">
              <span class="sr-only">quote</span> <x-mito::icon.quote class="w-5 h-5 text-gray-400" />
          </md-quote>
          <md-link x-ref="link" class="border rounded-sm px-2.5 py-1 text-sm" data-tippy-content="Add a link <cmd-k>" data-tippy-delay="[300, 0]">
              <span class="sr-only">link</span> <x-mito::icon.link class="w-5 h-5 text-gray-400" />
          </md-link>
        </markdown-toolbar>
        <textarea
            class="w-full mt-2 border border-gray-200"
            id="textarea_id"
            rows="10"
            x-on:keydown.meta.b.prevent="$refs.bold.click()"
            x-on:keydown.meta.i.prevent="$refs.italic.click()"
            x-on:keydown.meta.shift.period.prevent="$refs.quote.click()"
            x-on:keydown.meta.k.prevent="$refs.link.click()"
        ></textarea>
    </div>
</x-mito::html>
