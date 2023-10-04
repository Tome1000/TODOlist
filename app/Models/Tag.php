<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
   // id <unique, int ,primary key>
   // name <string, 255>

   // tag_id -> tags.id
   // task_id -> tasks.id


   protected $fillable = [
      'name'


  ];

   public function tasks()
   {

      return $this->belongsToMany(Task::class);
   }

   public function owner()
   {

       return $this->belongsTo(User::class, 'owner_id', 'id');
   }

   public function getDisplayName(){
      return implode(' ', array_map('ucfirst', explode(' ', $this->name)));

   }
}
