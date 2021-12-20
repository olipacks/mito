<?php
/**
 * Extracted from Blade UI Kit's markdown component.
 *
 * @link https://github.com/blade-ui-kit/blade-ui-kit
 */

namespace Olipacks\Mito\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use League\CommonMark\MarkdownConverterInterface;

class Markdown extends Component
{
    protected string $flavor;

    protected string $htmlInput;

    protected bool $allowUnsafeLinks;

    protected array $options;

    protected bool $anchors;

    public function __construct(
        string $flavor = 'default',
        string $htmlInput = 'allow',
        bool $allowUnsafeLinks = true,
        array $options = [],
        bool $anchors = false
    ) {
        $this->flavor = $flavor;
        $this->htmlInput = $htmlInput;
        $this->allowUnsafeLinks = $allowUnsafeLinks;
        $this->options = $options;
        $this->anchors = $anchors;
    }

    public function render(): View
    {
        return view('mito::components.markdown');
    }

    public function toHtml(string $markdown): string
    {
        if ($this->anchors) {
            $markdown = $this->generateAnchors($markdown);
        }

        return (string) $this->converter()->convertToHtml($markdown);
    }

    protected function converter(): MarkdownConverterInterface
    {
        $options = array_merge($this->options, [
            'html_input' => $this->htmlInput,
            'allow_unsafe_links' => $this->allowUnsafeLinks,
        ]);

        if ($this->flavor === 'github') {
            return new GithubFlavoredMarkdownConverter($options);
        }

        return new CommonMarkConverter($options);
    }

    protected function generateAnchors(string $markdown): string
    {
        preg_match_all('(```[a-z]*\n[\s\S]*?\n```)', $markdown, $matches);

        collect($matches[0] ?? [])->each(function (string $match, int $index) use (&$markdown) {
            $markdown = str_replace($match, "<!--code-block-$index-->", $markdown);
        });

        $markdown = collect(explode(PHP_EOL, $markdown))
            ->map(function (string $line) {
                // For levels 2 to 6.
                $anchors = [
                    '## ',
                    '### ',
                    '#### ',
                    '##### ',
                    '###### ',
                ];

                if (! Str::startsWith($line, $anchors)) {
                    return $line;
                }

                $title = trim(Str::after($line, '# '));
                $anchor = '<a class="anchor" name="'.Str::slug($title).'"></a>';

                return $anchor.PHP_EOL.$line;
            })
            ->implode(PHP_EOL);

        collect($matches[0] ?? [])->each(function (string $match, int $index) use (&$markdown) {
            $markdown = str_replace("<!--code-block-$index-->", $match, $markdown);
        });

        return $markdown;
    }
}
