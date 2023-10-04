<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;
use Illuminate\Support\Str;

class Task extends Model
{

    use HasFactory;
    // title - string, max 100 znakow
    // slug - string, mas 255 znakow, unikalny
    // content - string max 255 znakow
    // status - <active, completed> -string, wartosc z dostepnej listy

    protected const AVAILABLE_STATUSES = [
        'Active'    => 'active',
        'Completed' => 'completed',


    ];

    protected $fillable = [
        'title', 'slug', 'status', 'content',


    ];

    protected $attributes = [
        'content' => '',
        'status'  => self::AVAILABLE_STATUSES['Active']

    ];

    public static function getStatus(string $key)
    {
        if (!array_key_exists($key, self::AVAILABLE_STATUSES)) {
            throw new InvalidArgumentException(
                sprintf('Status for key [%s] does not exist.', $key)
            );
        }
        return self::AVAILABLE_STATUSES[$key];
    }

    public static function getAvailableStatuses(bool $keys = false)
    {

        return ($keys) ? array_keys(self::AVAILABLE_STATUSES) : array_values(self::AVAILABLE_STATUSES);
    }



    public function getRouteKeyName()
    {

        return 'slug';
    }



    public function setSlugAttribute(string $slug)
    {



        $this->attributes['slug'] = Str::slug($slug);
    }

    public function hasStatus(string $key)
    {

        return ($this->status == self::getStatus($key));
    }


    public function owner()
    {

        return $this->belongsTo(User::class, 'owner_id', 'id');
    }



    public function tags()
    {

        return $this->belongsToMany(Tag::class);
    }
}
