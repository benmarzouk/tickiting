<?php

namespace App\Model\MailJob;

use Illuminate\Database\Eloquent\Model;

class FaveoMail extends Model
{
    protected $table = 'Faveo_mails';
    protected $fillable = ['drive', 'key', 'value', 'email_id'];
}
