<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExpenseCategory
 *
 * @package App
 * @property string $name
*/
class ExpenseCategory extends Model
{
    protected $fillable = ['name','company_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        ExpenseCategory::observe(new \App\Observers\UserActionsObserver);

        static::addGlobalScope(new \App\Scopes\DefaultOrderScope);

        
          
        static::addGlobalScope(new \App\Scopes\CompanyScope);
            
        
    }
    
}
