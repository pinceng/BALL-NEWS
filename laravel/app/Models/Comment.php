<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

        use HasFactory;
    
        // protected $fillabel=['title','excerpt','body'];
        protected $guarded=['id'];
    
        public function scopeFilter($query, array $filters)
        {
            // if(isset($filters['search']) ? $filters['search'] : false)
            // {
            //    return $query->where('title','like','%'.$filters['search'].'%')   
            //     ->orWhere('body','like','%'.$filters['search'].'%');
            // }
    
            $query->when($filters['search'] ?? false, function ($query, $search){
                return $query->where('username','like','%'.$search.'%')
                ->orWhere('body','like','%'.$search.'%');
            });
        }
    
        public function category(){
            return $this->belongsTo(Category::class);
        }

        public function getRouteKeyName(){
            return 'slug';
            }
    
        public function sluggable(): array{
            return[
            'slug'=>[
            'source'=>'title'
            ]
            ];
            }
    }   
