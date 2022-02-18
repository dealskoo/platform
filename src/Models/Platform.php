<?php

namespace Dealskoo\Platform\Models;

use Dealskoo\Admin\Traits\HasSlug;
use Dealskoo\Country\Traits\HasCountry;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Platform extends Model
{
    use HasFactory, SoftDeletes, HasCountry, HasSlug;
}
