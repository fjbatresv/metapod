<?php

namespace Metapod\SoporteBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'bitacora' table.
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
class BitacoraTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Metapod.SoporteBundle.Model.map.BitacoraTableMap';

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
        $this->setName('bitacora');
        $this->setPhpName('Bitacora');
        $this->setClassname('Metapod\\SoporteBundle\\Model\\Bitacora');
        $this->setPackage('src.Metapod.SoporteBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('descripcion', 'Descripcion', 'LONGVARCHAR', true, null, null);
        $this->addColumn('direccion', 'Direccion', 'VARCHAR', true, 15, null);
        $this->addColumn('fecha_hora', 'FechaHora', 'TIMESTAMP', true, null, null);
        $this->addForeignKey('usuario_id', 'UsuarioId', 'INTEGER', 'usuario', 'id', false, null, null);
        $this->addColumn('tabla', 'Tabla', 'VARCHAR', false, 100, null);
        $this->addColumn('dato_tabla', 'DatoTabla', 'INTEGER', false, null, null);
        $this->addColumn('error', 'Error', 'VARCHAR', false, 255, null);
        $this->addColumn('dato_error', 'DatoError', 'VARCHAR', false, 255, null);
        $this->addColumn('estado', 'Estado', 'INTEGER', true, null, null);
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
        $this->addRelation('Usuario', 'Metapod\\SoporteBundle\\Model\\Usuario', RelationMap::MANY_TO_ONE, array('usuario_id' => 'id', ), null, null);
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

} // BitacoraTableMap
