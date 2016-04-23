<?php

namespace Metapod\SoporteBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'menu' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.src.Metapod.SoporteBundle.Model.map
 */
class MenuTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Metapod.SoporteBundle.Model.map.MenuTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('menu');
        $this->setPhpName('Menu');
        $this->setClassname('Metapod\\SoporteBundle\\Model\\Menu');
        $this->setPackage('src.Metapod.SoporteBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('nombre', 'Nombre', 'VARCHAR', true, 100, null);
        $this->getColumn('nombre', false)->setPrimaryString(true);
        $this->addColumn('ruta', 'Ruta', 'VARCHAR', true, 100, null);
        $this->addColumn('superior', 'Superior', 'INTEGER', true, null, null);
        $this->addColumn('mostrar', 'Mostrar', 'INTEGER', true, 1, null);
        $this->addColumn('icono', 'Icono', 'VARCHAR', false, 100, null);
        $this->addColumn('created_by', 'CreatedBy', 'VARCHAR', false, 50, null);
        $this->addColumn('updated_by', 'UpdatedBy', 'VARCHAR', false, 50, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('PerfilMenu', 'Metapod\\SoporteBundle\\Model\\PerfilMenu', RelationMap::ONE_TO_MANY, array('id' => 'menu_id', ), 'CASCADE', null, 'PerfilMenus');
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' =>  array (
  'create_column' => 'created_at',
  'update_column' => 'updated_at',
  'disable_updated_at' => 'false',
),
        );
    } // getBehaviors()

} // MenuTableMap
