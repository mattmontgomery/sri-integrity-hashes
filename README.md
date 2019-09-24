# SRI Integrity Hash helper

This is a small class to make interacting with SRI hashes a bit simpler and easier.

Most use cases will want to use the `Loaders` class (see example below).

## Standard Format

Out of the box, assets can be loaded, provided they are in the following format:

```js
{
    "scriptName": {
        "src": "script-src.js",
        "integrity": "sha512-test"
    },
    "anotherScriptName": {
        "src": "another-script-src.js",
        "integrity": "sha512-test"
    }
}
```

This can be easily generated from Webpack using the library [webpack-assets-manifest](https://github.com/webdeveric/webpack-assets-manifest).

## Other formats

In the case that aother formats are provided or desired, a new Loader implementing `LoaderInterface` may be passed to the `Loaders` class.

## Example

```php
use DDM\SRIIntegrityHash\Loaders;
use DDM\SRIIntegrityHash\Loader;

$loaders = new Loaders();
$loaders->register(new Loader('example/assets.json'));

$file = $loaders->getFile('example/assets.json', 'common.js');

echo sprintf("Loaded %s from %s\n", $file->filename, $file->namespace);
echo sprintf("Script tag: %s\n", $file->toScript());
```

## Todo

- A set of scripts to generate a manifest and corresponding integrity hashes for any desired files (CLI?)