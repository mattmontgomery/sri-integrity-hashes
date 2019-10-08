![](https://travis-ci.com/mattmontgomery/sri-integrity-hashes.svg?branch=master)
[![codecov](https://codecov.io/gh/mattmontgomery/sri-integrity-hashes/branch/master/graph/badge.svg)](https://codecov.io/gh/mattmontgomery/sri-integrity-hashes)    

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

$loaders = new Loaders();

$file = $loaders->getFile('example/assets.json', 'common.js');

echo sprintf("Loaded %s from %s\n", $file->filename, $file->namespace);
echo sprintf("Script tag: %s\n", $file->toScript());
```

#### Using other loaders

By default, the file loader (`DDM\SRIIntegrityHash\FileLoader`) will be used. You can register other autoloaders if you
are loading via another source.

## Generator

A script and set of classes exists for generating new asset maps. A command is present in `bin/console.php` which can be used
to output JSON, usually to put into its own file. It takes any number of arguments and generates hashes for those files.
See below for script usage.

### Script usage

If running from this repository:

```bash
php bin/sri-assets-generator generate --file=https://apis.google.com/js/api.js --file=https://apis.google.com/js/api-mock.js
```

If running from a composer installation:

```bash
./vendor/bin/sri-assets-generator ...
```

### Defining a script in composer.json

If you want a quick and easy way to do the above, you might want to define a scripts entry in your `composer.json`.

```js
{
  ...
  "scripts": {
    "generate-assets-map": "sri-assets-generator generate --file=https://apis.google.com/js/api.js"
  }
}
```

### Reading from other sources

If you'd like to read from other sources  — say, a JSON file with a list of hashes, or an API result, or the database,
or something other than just using `file_get_contents`, you can create a new Reader implementing `ReaderInterface`.
It can be passed in with as `Generator::read(ReaderInterface, resource)`.
