<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeAttachmentModel extends Model
{
    use HasFactory;

    protected $table = 'me_attachments';

    protected $primaryKey = 'mea_id';
}
