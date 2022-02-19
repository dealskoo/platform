<?php

namespace Dealskoo\Platform\Tests;

use Dealskoo\Platform\Traits\HasPlatform;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasPlatform;

    protected $fillable = ['name'];
}
