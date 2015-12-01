<?php namespace Convergence\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

	protected $table = 'groups';
	protected $fillable = ['name','display_name','description','group_type_id'];

	public function roles()
	{
		return $this->belongsToMany('Convergence\Models\Role');
	}

	public function group_type() 
	{
		return $this->belongsTo('Convergence\Models\GroupType');
	}

}
