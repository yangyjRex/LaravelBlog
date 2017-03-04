<?php
/**
 * Created by PhpStorm.
 * User: rexyang
 * Date: 2/03/17
 * Time: 11:02 PM
 */

namespace App\Http\Model;
use Illuminate\Database\Eloquent\Model;


class Article extends Model
{
    protected $table = 'article';
    protected $primaryKey = 'art_id';
    public $timestamps = false;
    protected $guarded = [];

}