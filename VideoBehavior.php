<?php

namespace Creonit\PropelVideoBehavior;

use Propel\Generator\Model\Behavior;
use Propel\Generator\Model\ForeignKey;

class VideoBehavior extends Behavior
{
    protected $parameters = [
        'parameter' => 'video_id',
    ];
    
    
    protected function addImageColumn($columnName){
        $table = $this->getTable();

        $table->addColumn([
            'name' => $columnName,
            'type' => 'integer'
        ]);

        $fk = new ForeignKey();
        $fk->setForeignTableCommonName('video');
        $fk->setForeignSchemaName($table->getSchema());
        $fk->setDefaultJoin('LEFT JOIN');
        $fk->setOnDelete(ForeignKey::SETNULL);
        $fk->setOnUpdate(ForeignKey::CASCADE);
        $fk->addReference($columnName, 'id');
        $table->addForeignKey($fk);
    }

    public function modifyTable()
    {

        $columns = explode(',', $this->getParameter('parameter'));
        foreach ($columns as $column){
            $this->addImageColumn(trim($column));
        }

    }
}