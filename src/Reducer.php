<?php

namespace Pyaesone17\S3Reducer;

use Storage, Exception;

class Reducer
{
    /**
     * Create a new Skeleton Instance
     */
    public function __construct($bucketName)
    {
        $this->bucketName = $bucketName;
    }

    /**
     * Friendly welcome
     *
     * @param string $phrase Phrase to return
     *
     * @return string Returns the phrase passed in
     */
    public function path($path)
    {
        $originalPath = $path;
        $path = $this->extractPath($path);

        try{
            if (! Storage::disk('public')->exists($path)) {
                $pathWithoutBucket = $this->pathWithoutBucket($path);
                $content = Storage::disk('s3')->get($pathWithoutBucket);

                Storage::disk('public')->put($path, $content);
            }
            return Storage::disk('public')->url($path);
        } catch (Exception $e) {
            \Log::info($e);
            return $originalPath;
        }
    }

    public function extractPath($fullPath)
    {
        $parsed_url = parse_url($fullPath);

        $path = $parsed_url['path'];
        $host = isset($parsed_url['host']) ? $parsed_url['host'] : null;
        
        $path = $this->addSlash($path);
        
        if ($this->isDnsStyle($host) || $this->isBucketNameInclude($path)===false) {
            $path = $this->bucketName.$path;
            return $this->purifyUrl($path);
        }

        return $this->purifyUrl($path);
    }

    public function purgeCache($path)
    {
        $path = $this->extractPath($path);
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    protected function pathWithoutBucket($purifiedUrl)
    {
        return str_replace($this->bucketName,"",$purifiedUrl);
    }

    protected function addSlash($path)
    {
        if(strpos($path, '/')==0){
            return $path;
        }
        return "/".$path;
    }

    protected function purifyUrl($path)
    {
        return ltrim($path,'/');
    }
    
    protected function isDnsStyle($host)
    {
        if (strpos($host, $this->bucketName) !== false) {
            return true;
        }

        return false;
    }

    protected function isBucketNameInclude($path)
    {
        if (strpos($path, $this->bucketName) !== false) {
            return true;
        }

        return false;
    }
}
