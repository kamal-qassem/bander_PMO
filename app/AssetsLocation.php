<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AssetsLocation
 *
 * @package App
 * @property string $title
*/
class AssetsLocation extends Model
{
    protected $fillable = ['title','company_id'];
    protected $hidden = [];
    public static $searchable = [ 'title' ];
    
    public static function boot()
    {
   
    
        
        parent::boot();

        AssetsLocation::observe(new \App\Observers\UserActionsObserver);

        static::addGlobalScope(new \App\Scopes\DefaultOrderScope);
        static::addGlobalScope(new \App\Scopes\CompanyScope);

    }

     public function status()
    {
        return $this->belongsTo(AssetsStatus::class, 'status_id');
    }
    
}
