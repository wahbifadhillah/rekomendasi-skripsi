<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = true;
    protected $table = 'nodes';
    protected $fillable = [
    'node_id', 'tree_id', 'node_parent', 'node_name','node_value', 'node_leaf_purity'];
}
