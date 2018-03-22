# S3Reducer

Small , minimalist but effective library to reduce your s3 billing dramatically just by calling custom asset function.
Song interesting ? Let's try and check your monthly billing.
You will ever want to treat me beer for that.

## Theory
I found out that I have to bill $50 per month for one of my application that is using s3.
For read requests, it is like 46$. But only 4$ for put and delete requests.
Therefore, If I can reduce the amout of read requests, I only have to pay like $6 per month.
And this library emerge.

## Library Design
This is the concept of chaining the responsiblity. When you use s3_reducer

``` php
 <img src="{{ s3_reducer($img->path) }}"/>
```

like this, the library will check local filesystem first. 
If the library exists in local it will server from local cache.
If the libary cant find it on local server, 
it will download the asset from the s3 server and store it on local server. 
After that it will serve assets to the user.
Therefore, you will only have to pay for s3 when no local cache file is exist.

## Structure

If any of the following are applicable to your project, then the directory structure should follow industry best practices by being named the following.

```     
config/
src/
tests/
```

## Install

Via Composer

``` bash
$ composer require pyaesone17/s3_reducer
```

If you are using below laravel 5.4, you have to register service provider like this.
``` php
'providers' => [
  Pyaesone17\S3ReducerS3\ReducerServiceProvider::class
]
```

## Usage

I recommend to use unique image path when uploading to s3 server.
Because this library will make folder like s3 bucket style.

``` php
<img src="{{ s3_reducer($img->path) }}"/>
```

## Purge Cache
If you are using unique path style for every image upload.
You don't have to purge the cache of assets.
To clear the local cache image, you can even use this function.

``` php
s3_reduce_purge($image->path); 
```

## Cron Job
To avoid, you local server full with s3 images.
You should add task scheduling like this in App\Console\Kernel.php

``` php
$schedule->command('s3reducer:purge')->weekly();
```

## Testing

``` bash
$ composer test
```

## Note
It is just for showing frequent read requests to s3 assets.
But for manipulating media, you should try to do it on actual s3 storage.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
