<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskTag
 *
 * @package App
 * @property string $name
*/
class TaskTag extends Model
{
    protected $fillable = ['name','company_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        TaskTag::observe(new \App\Observers\UserActionsObserver);

        static::addGlobalScope(new \App\Scopes\DefaultOrderScope);
        
          
        static::addGlobalScope(new \App\Scopes\CompanyScope);
            
       
    }
    
}
