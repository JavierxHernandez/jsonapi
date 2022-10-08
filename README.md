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

Note: Is use to formatter the resource with the structure api:json out of the controller.

## Api Prefix

This is changed in the RouteServiceProvider.

## Create a ResourceCollection with:

php artisan make:resource ArticleCollection

note: When using resources of type "resource and collection" there is a convention when creating them. You must use the singular name in the 2 files to form a relationship so you can use the $this->collection to call the "resource" in the "collection". In the case that these names are different, a $collects will be added.
