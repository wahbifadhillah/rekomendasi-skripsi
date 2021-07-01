<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    protected $table = 'nodes';
    protected $fillable = [
    'node_id', 'tree_id', 'node_parent', 'node_name','node_value', 'node_leaf_purity'];
}
