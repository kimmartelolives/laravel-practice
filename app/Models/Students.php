<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    //kapag lahat gusto ipa-edit
    protected $guarded = [];

    //kapag specific lang gusto ipa-edit
    // protected $fillable = ['first_name', 'last_name'];
    use HasFactory;
}
