<?php

namespace Metapod\SoporteBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'usuario' table.
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
class UsuarioTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Metapod.SoporteBundle.Model.map.UsuarioTableMap';

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
        $this->setName('usuario');
        $this->setPhpName('Usuario');
        $this->setClassname('Metapod\\SoporteBundle\\Model\\Usuario');
        $this->setPackage('src.Metapod.SoporteBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('nombre', 'Nombre', 'VARCHAR', true, 45, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 100, null);
        $this->addColumn('salt', 'Salt', 'VARCHAR', false, 255, null);
        $this->addColumn('apellido', 'Apellido', 'VARCHAR', false, 45, null);
        $this->addColumn('username', 'Username', 'VARCHAR', true, 45, null);
        $this->getColumn('username', false)->setPrimaryString(true);
        $this->addColumn('password', 'Password', 'VARCHAR', true, 45, null);
        $this->addColumn('direccion', 'Direccion', 'VARCHAR', false, 100, null);
        $this->addColumn('fecha_nacimiento', 'FechaNacimiento', 'TIMESTAMP', false, null, null);
        $this->addColumn('ultimo_cambio_password', 'UltimoCambioPassword', 'DATE', false, null, null);
        $this->addForeignKey('estado_usuario_id', 'EstadoUsuarioId', 'INTEGER', 'estado_usuario', 'id', true, null, null);
        $this->addColumn('record_password', 'RecordPassword', 'LONGVARCHAR', false, null, null);
        $this->addColumn('avatar', 'Avatar', 'LONGVARCHAR', false, null, null);
        $this->addColumn('conectado', 'Conectado', 'BOOLEAN', true, 1, false);
        $this->addColumn('ultima_ip', 'UltimaIp', 'VARCHAR', false, 20, null);
        $this->addColumn('empresa_id', 'EmpresaId', 'INTEGER', false, null, null);
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
        $this->addRelation('EstadoUsuario', 'Metapod\\SoporteBundle\\Model\\EstadoUsuario', RelationMap::MANY_TO_ONE, array('estado_usuario_id' => 'id', ), null, null);
        $this->addRelation('Bitacora', 'Metapod\\SoporteBundle\\Model\\Bitacora', RelationMap::ONE_TO_MANY, array('id' => 'usuario_id', ), null, null, 'Bitacoras');
        $this->addRelation('UsuarioPerfil', 'Metapod\\SoporteBundle\\Model\\UsuarioPerfil', RelationMap::ONE_TO_MANY, array('id' => 'usuario_id', ), 'CASCADE', 'CASCADE', 'UsuarioPerfils');
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

} // UsuarioTableMap
