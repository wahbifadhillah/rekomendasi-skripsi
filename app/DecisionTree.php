<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DecisionTree extends Model
{
    protected $table = 'decision_trees';
    protected $primaryKey = 'tree_id';
    protected $fillable = [
        'tree_id', 'node_id', 'tree_name', 'tree_training_data', 'tree_testing_data', 'tree_accuracy', 'tree_precision', 'tree_recall', 'tree_size', 'tree_leaves','tree_instances', 'tree_graph', 'tree_rules'];
}
