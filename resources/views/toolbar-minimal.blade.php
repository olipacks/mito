<x-mito::html>
    <div class="max-w-lg mx-auto py-20" x-data>
        <markdown-toolbar class="flex space-x-2" for="markdown">
            <md-bold x-ref="bold">bold</md-bold>
            <md-italic x-ref="italic">italic</md-italic>
            <md-quote x-ref="quote">quote</md-quote>
            <md-link x-ref="link">link</md-link>
        </markdown-toolbar>

        <textarea
            x-on:keydown.meta.b.prevent="$refs.bold.click()"
            x-on:keydown.meta.i.prevent="$refs.italic.click()"
            x-on:keydown.meta.shift.period.prevent="$refs.quote.click()"
            x-on:keydown.meta.k.prevent="$refs.link.click()"
            class="w-full mt-2"
            id="markdown"
            rows="10"
        ></textarea>
    </div>
</x-mito::html>
