<?php
/**
 * Use Ace editor for the sql request editor
 *
 * @link https://…
 *
 * @author Nicolas Masson
 * @GPL (http://leneko.github.com/)
 */

class AdminerAce
{
    private $done = false;

    public function __construct($theme = "vibrant_ink")
    {
        $this->theme = $theme;
    }

    public function name()
    {
        Adminer::name();
        if ($this->done) {
            return;
        }
        // Jquery
        echo script_src("//code.jquery.com/jquery-3.3.1.slim.min.js");

        // ACE editor CDN
        $conf = [
            "cdn" => "//cdnjs.cloudflare.com/ajax/libs/ace",
            "version" => "1.4.1",
        ];
        $base = implode("/", $conf) . "/";
        $js = [
            "ace.js",
            "mode-mysql.js",
            "ext-language_tools.js",
            "snippets/mysql.js",
            "theme-{$this->theme}.js",
        ];

        foreach ($js as $src) {
            echo script_src($base . $src);
        }

        echo $this->load("style.html");
        echo script($this->load("main.js"));

        $this->done = true;
    }

    private function load($file)
    {
        $that = $this;
        $callback = function ($m) use ($that) {
            return $that->{$m[1]};
        };

        $tpl = file_get_contents(__DIR__ . "/" . $file);
        $data = preg_replace_callback("/###(.*)###/", $callback, $tpl);
        return $data;
    }
}
