## Blueprint Install in dev

composer require laravel-shift/Blueprint --dev

## Generate the Blueprint file to config de scheme

php artisan blueprint:new

## Edit Blueprint Config

php artisan vendor:publish 

'use_constraints' => true
'use_guarded' => true

## Blueprint build

php artisan blueprint:build

Note: In real projects is recommended set in the git ignore the ".blueprint" and "draft.yaml" file.

## Modified the example test structure with stub

php artisan stub:publish



