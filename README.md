# Adminer Ace editor Plugins (for SQL request)

Replace the basic textarea with a nice Ace code editor (from CDN), with basic code completion.

- Copy files in the `plugins/` folder.
- Modify your `index.php` to include the plugin, ex.:

```php
<?php
function adminer_object() {
    // required to run any plugin
    include_once "./plugins/plugin.php";

    // autoloader
    foreach (glob("plugins/*.php") as $filename) {
        include_once "./$filename";
    }

    $plugins = array(
        // specify enabled plugins here
        // here AdminerAce with the theme name as arguement (default is monokai)
        new AdminerAce("<theme>"),
    );

    return new AdminerPlugin($plugins);
}

// include original Adminer or Adminer Editor
include "./adminer.php";
?>
```

- replace `<theme>` with one available [here](https://github.com/ajaxorg/ace/tree/master/lib/ace/theme)
