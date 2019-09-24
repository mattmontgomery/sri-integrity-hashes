# SRI Integrity Hash helper

## Loader/Loaders

This is a small class to make interacting with SRI hashes a bit simpler and easier.

Most use cases will want to use the `Loaders` class (see example below).

### Standard Format

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

### Other formats

In the case that other formats are provided or desired, a new Loader implementing `LoaderInterface` may be passed to the `Loaders` class.

### Example

```php
use DDM\SRIIntegrityHash\Loaders;
use DDM\SRIIntegrityHash\Loader;

$loaders = new Loaders();
$loaders->register(new Loader('example/assets.json'));

$file = $loaders->getFile('example/assets.json', 'common.js');

echo sprintf("Loaded %s from %s\n", $file->filename, $file->namespace);
echo sprintf("Script tag: %s\n", $file->toScript());
```

## Generator

A script and set of classes exists for generating new asset maps. A script is present in `bin/generate.php` which can be used
to output JSON, usually to put into its own file. It takes any number of arguments and generates hashes for those files.

### Script usage

```bash
php bin/example.php https://apis.google.com/js/api.js https://apis.google.com/js/api-mock.js
```

### Reading from other formats

If you'd like to read from other formats — say, a JSON file with a list of hashes, or an API result, or the database, or something
other than just using `file_get_contents`, you can create a new Reader implementing `ReaderInterface`. It can be passed in with
as `Generator::read(ReaderInterface, resource)`.

## Todo

- A set of scripts to generate a manifest and corresponding integrity hashes for any desired files (CLI?)