# Underpin Block Loader

Loader That assists with adding blocks to a WordPress website.

## Installation

### Using Composer

`composer require underpin/block-loader`

### Manually

This plugin uses a built-in autoloader, so as long as it is required _before_
Underpin, it should work as-expected.

`require_once(__DIR__ . '/underpin-blocks/blocks.php');`

## Setup

1. Install Underpin. See [Underpin Docs](https://www.github.com/underpin-wp/underpin)
1. Register new blocks menus as-needed.

## Example

A very basic example could look something like this. Note that your block will not display unless registered in Javascript
as well.

```php
// Register styles and scripts.
underpin()->styles()->add( 'test-style', [/*...*/] );
underpin()->scripts()->add( 'test-script', [/*...*/] );

// Register block
underpin()->blocks()->add( 'test', [
	'name'        => 'Test Block',
	'description' => 'Description for block.',
	'type'        => underpin()->dir() . 'block.json', // Can be the block ID or a link to a block.json file. See register_block_type
	'args'        => [],                               // Optional. See register_block_type
] );

```

Alternatively, you can extend `Block` and reference the extended class directly, like so:

```php
underpin()->blocks()->add('block-key','Namespace\To\Class');
```
