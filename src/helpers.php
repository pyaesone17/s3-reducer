<?php 

function s3_reducer($path)
{
    return app()->make('Pyaesone17\S3Reducer\Reducer')->path($path);
}

function s3_reduce_purge($path)
{
    return app()->make('Pyaesone17\S3Reducer\Reducer')->purgeCache($path);
}
