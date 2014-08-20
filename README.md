# FlexPress shortcode component

## Install with Pimple
The Shortcode component uses two classes:
- AbstractShortcode, which you extend to create a Shortcode.
- ShortcodeHelper, which hooks into everything for you and registers the shortcodes.

Lets create a pimple config for both of these

```
$pimple["documentLinkShortcode"] = function () {
  return new DocumentLink();
};

$pimple['ShortcodeHelper'] = function ($c) {
    return new ShortcodeHelper($c['objectStorage'], array(
        $c["documentLinkShortcode"]
    ));
};
```
- Note the dependency $c['objectStorage']  is a SPLObjectStorage

## Creating a concreate shortcode class
Create a concreate class that implements the AbstractShortcode class and implements the getName() and getCallback() methods.

```
class DocumentLink extends AbstractShortcode {

    public function getName()
    {
      return "document_link";
    }
    
    public function getCallback()
    {
      $link = func_get_arg(0);
      return '<a href="' . $link . '">Download document</a>';
    }

}
```

### Public Methods
- getName() - returns the name of the shortcode that will be used in the editor.
- getCallback() - returns the markup of the shortcode.

## ShortcodeHelper usage

Once you have setup the pimple config you are use the ShortcodeHelper like this
```
$helper = $pimple['ShortcodeHelper'];
$helper->registerShortcodes();
```
That's it, the helper will then add all the needed hooks and register all the shortcodes you have provided it.

### Public methods
- registerShortcodes() - Registers the shortcodes provided.
