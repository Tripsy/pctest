Description
=========================

PHP test project which generate a html label

Requirements
=========================
PHP 7.0 or higher
Composer for installation

Installation
=========================
composer require "tripsy/pctest"

Usage
=========================

Accept a set of data sent via POST json and outputs html for a label.

Sample data in test.http (work with REST Client VSCode extension)

Output as content-Type: text/html

Notes
=========================

Run phpUnit tests using following command:
$ vendor\bin\phpunit test

Resources
=========================

https://github.com/jenssegers/blade
https://github.com/rakit/validation