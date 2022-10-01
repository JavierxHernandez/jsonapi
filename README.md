## Notes
## Blueprint Install in dev

composer require laravel-shift/Blueprint --dev

## Generate the Blueprint file to set up the model scheme

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

## Resource

php artisan make:resource ArticleResource

Note: Is use to formatter the resource with the structure api:json without the controller.

## Api Prefix

This is changed in the RouteServiceProvider.
