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

## Header validation Json:api

php artisan make:middleware ValidateJsonApiHeaders
Note: The middleware for routes is configured in the App Kernel.

(Request): GET | POST | PATCH | DELETE
sent: accept application/vnd.api+json
Or get: 406 Not Acceptable

In POST | PATCH | DELETE
Add: content-type application/vnd.api+json
Or get: 415 Unsupported Media Type

(Responses)
content-type application/vnd.api+json

## Testing Helpers

First I created the trait to add the headers in the test requests and use them in the testCase. this prevented errors in the json call request in the tests.

## Json api validation error response

"errors": {
    "title": "Invalid data",
    "detail": "Title is required",
    "source": [
        "pointer": "/data/attributes/title"
    ]
}

## Testing response helpers

The good practice for adding macros is to create a new service provider and implement in the boot method inside it.

php artisan make:provider JsonApiServiceProvider

and configure the new provider inside config/app.php in the providers section.

## Validating JSON:API Document
