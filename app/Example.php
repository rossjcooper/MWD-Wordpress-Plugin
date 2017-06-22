<?php
namespace MWDPlugin;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Example
 *
 * An example of how we can use Eloquent models in WordPress.
 *
 * @package MWDPlugin
 */
class Example extends Model
{
    protected $fillable = ['name']; //Just like Laravel 5
}