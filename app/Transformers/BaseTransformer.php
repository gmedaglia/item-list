<?php
namespace App\Transformers;

use App\Item;
use League\Fractal\TransformerAbstract;
use Jenssegers\Mongodb\Eloquent\Model;

class BaseTransformer extends TransformerAbstract
{
	public function transform(Model $model)
	{
	    return (array) $model;
	}
}