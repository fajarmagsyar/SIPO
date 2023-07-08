<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogActivity extends Model
{
    use HasFactory, SoftDeletes;

    protected $keyType = 'string';
    protected $primaryKey = 'log_activity_id';
    protected $table = 'log_activity';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = ['log_activity_id'];
}
