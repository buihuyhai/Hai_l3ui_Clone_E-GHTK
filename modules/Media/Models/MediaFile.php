<?php

namespace Modules\Media\Models;

use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    protected $table = "media_files";

    protected $fillable = [
        "file_name",
        "file_path",
        "file_size",
        "file_type",
        "file_extension",
        "url",
        "user_create",
        "user_update"
    ];

}
