<?php namespace ZN\FileSystem\Exception;

use GeneralException;

class FileRemoteUploadException extends GeneralException
{
    public function __construct($file)
    {
        parent::__construct(\Lang::select('Exception', 'fileRemoteUpload', $file));
    }
}
