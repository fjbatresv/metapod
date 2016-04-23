<?php

namespace Metapod\SoporteBundle\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Metapod\SoporteBundle\Model\Bitacora;
use Metapod\SoporteBundle\Model\EstadoUsuario;
use Metapod\SoporteBundle\Model\Usuario;
use Metapod\SoporteBundle\Model\UsuarioPeer;
use Metapod\SoporteBundle\Model\UsuarioPerfil;
use Metapod\SoporteBundle\Model\UsuarioQuery;

/**
 * @method UsuarioQuery orderById($order = Criteria::ASC) Order by the id column
 * @method UsuarioQuery orderByNombre($order = Criteria::ASC) Order by the nombre column
 * @method UsuarioQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method UsuarioQuery orderBySalt($order = Criteria::ASC) Order by the salt column
 * @method UsuarioQuery orderByApellido($order = Criteria::ASC) Order by the apellido column
 * @method UsuarioQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method UsuarioQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method UsuarioQuery orderByDireccion($order = Criteria::ASC) Order by the direccion column
 * @method UsuarioQuery orderByFechaNacimiento($order = Criteria::ASC) Order by the fecha_nacimiento column
 * @method UsuarioQuery orderByUltimoCambioPassword($order = Criteria::ASC) Order by the ultimo_cambio_password column
 * @method UsuarioQuery orderByEstadoUsuarioId($order = Criteria::ASC) Order by the estado_usuario_id column
 * @method UsuarioQuery orderByRecordPassword($order = Criteria::ASC) Order by the record_password column
 * @method UsuarioQuery orderByAvatar($order = Criteria::ASC) Order by the avatar column
 * @method UsuarioQuery orderByConectado($order = Criteria::ASC) Order by the conectado column
 * @method UsuarioQuery orderByUltimaIp($order = Criteria::ASC) Order by the ultima_ip column
 * @method UsuarioQuery orderByEmpresaId($order = Criteria::ASC) Order by the empresa_id column
 * @method UsuarioQuery orderByCreatedBy($order = Criteria::ASC) Order by the created_by column
 * @method UsuarioQuery orderByUpdatedBy($order = Criteria::ASC) Order by the updated_by column
 * @method UsuarioQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method UsuarioQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method UsuarioQuery groupById() Group by the id column
 * @method UsuarioQuery groupByNombre() Group by the nombre column
 * @method UsuarioQuery groupByEmail() Group by the email column
 * @method UsuarioQuery groupBySalt() Group by the salt column
 * @method UsuarioQuery groupByApellido() Group by the apellido column
 * @method UsuarioQuery groupByUsername() Group by the username column
 * @method UsuarioQuery groupByPassword() Group by the password column
 * @method UsuarioQuery groupByDireccion() Group by the direccion column
 * @method UsuarioQuery groupByFechaNacimiento() Group by the fecha_nacimiento column
 * @method UsuarioQuery groupByUltimoCambioPassword() Group by the ultimo_cambio_password column
 * @method UsuarioQuery groupByEstadoUsuarioId() Group by the estado_usuario_id column
 * @method UsuarioQuery groupByRecordPassword() Group by the record_password column
 * @method UsuarioQuery groupByAvatar() Group by the avatar column
 * @method UsuarioQuery groupByConectado() Group by the conectado column
 * @method UsuarioQuery groupByUltimaIp() Group by the ultima_ip column
 * @method UsuarioQuery groupByEmpresaId() Group by the empresa_id column
 * @method UsuarioQuery groupByCreatedBy() Group by the created_by column
 * @method UsuarioQuery groupByUpdatedBy() Group by the updated_by column
 * @method UsuarioQuery groupByCreatedAt() Group by the created_at column
 * @method UsuarioQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method UsuarioQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method UsuarioQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method UsuarioQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method UsuarioQuery leftJoinEstadoUsuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the EstadoUsuario relation
 * @method UsuarioQuery rightJoinEstadoUsuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EstadoUsuario relation
 * @method UsuarioQuery innerJoinEstadoUsuario($relationAlias = null) Adds a INNER JOIN clause to the query using the EstadoUsuario relation
 *
 * @method UsuarioQuery leftJoinBitacora($relationAlias = null) Adds a LEFT JOIN clause to the query using the Bitacora relation
 * @method UsuarioQuery rightJoinBitacora($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Bitacora relation
 * @method UsuarioQuery innerJoinBitacora($relationAlias = null) Adds a INNER JOIN clause to the query using the Bitacora relation
 *
 * @method UsuarioQuery leftJoinUsuarioPerfil($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsuarioPerfil relation
 * @method UsuarioQuery rightJoinUsuarioPerfil($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsuarioPerfil relation
 * @method UsuarioQuery innerJoinUsuarioPerfil($relationAlias = null) Adds a INNER JOIN clause to the query using the UsuarioPerfil relation
 *
 * @method Usuario findOne(PropelPDO $con = null) Return the first Usuario matching the query
 * @method Usuario findOneOrCreate(PropelPDO $con = null) Return the first Usuario matching the query, or a new Usuario object populated from the query conditions when no match is found
 *
 * @method Usuario findOneByNombre(string $nombre) Return the first Usuario filtered by the nombre column
 * @method Usuario findOneByEmail(string $email) Return the first Usuario filtered by the email column
 * @method Usuario findOneBySalt(string $salt) Return the first Usuario filtered by the salt column
 * @method Usuario findOneByApellido(string $apellido) Return the first Usuario filtered by the apellido column
 * @method Usuario findOneByUsername(string $username) Return the first Usuario filtered by the username column
 * @method Usuario findOneByPassword(string $password) Return the first Usuario filtered by the password column
 * @method Usuario findOneByDireccion(string $direccion) Return the first Usuario filtered by the direccion column
 * @method Usuario findOneByFechaNacimiento(string $fecha_nacimiento) Return the first Usuario filtered by the fecha_nacimiento column
 * @method Usuario findOneByUltimoCambioPassword(string $ultimo_cambio_password) Return the first Usuario filtered by the ultimo_cambio_password column
 * @method Usuario findOneByEstadoUsuarioId(int $estado_usuario_id) Return the first Usuario filtered by the estado_usuario_id column
 * @method Usuario findOneByRecordPassword(string $record_password) Return the first Usuario filtered by the record_password column
 * @method Usuario findOneByAvatar(string $avatar) Return the first Usuario filtered by the avatar column
 * @method Usuario findOneByConectado(boolean $conectado) Return the first Usuario filtered by the conectado column
 * @method Usuario findOneByUltimaIp(string $ultima_ip) Return the first Usuario filtered by the ultima_ip column
 * @method Usuario findOneByEmpresaId(int $empresa_id) Return the first Usuario filtered by the empresa_id column
 * @method Usuario findOneByCreatedBy(string $created_by) Return the first Usuario filtered by the created_by column
 * @method Usuario findOneByUpdatedBy(string $updated_by) Return the first Usuario filtered by the updated_by column
 * @method Usuario findOneByCreatedAt(string $created_at) Return the first Usuario filtered by the created_at column
 * @method Usuario findOneByUpdatedAt(string $updated_at) Return the first Usuario filtered by the updated_at column
 *
 * @method array findById(int $id) Return Usuario objects filtered by the id column
 * @method array findByNombre(string $nombre) Return Usuario objects filtered by the nombre column
 * @method array findByEmail(string $email) Return Usuario objects filtered by the email column
 * @method array findBySalt(string $salt) Return Usuario objects filtered by the salt column
 * @method array findByApellido(string $apellido) Return Usuario objects filtered by the apellido column
 * @method array findByUsername(string $username) Return Usuario objects filtered by the username column
 * @method array findByPassword(string $password) Return Usuario objects filtered by the password column
 * @method array findByDireccion(string $direccion) Return Usuario objects filtered by the direccion column
 * @method array findByFechaNacimiento(string $fecha_nacimiento) Return Usuario objects filtered by the fecha_nacimiento column
 * @method array findByUltimoCambioPassword(string $ultimo_cambio_password) Return Usuario objects filtered by the ultimo_cambio_password column
 * @method array findByEstadoUsuarioId(int $estado_usuario_id) Return Usuario objects filtered by the estado_usuario_id column
 * @method array findByRecordPassword(string $record_password) Return Usuario objects filtered by the record_password column
 * @method array findByAvatar(string $avatar) Return Usuario objects filtered by the avatar column
 * @method array findByConectado(boolean $conectado) Return Usuario objects filtered by the conectado column
 * @method array findByUltimaIp(string $ultima_ip) Return Usuario objects filtered by the ultima_ip column
 * @method array findByEmpresaId(int $empresa_id) Return Usuario objects filtered by the empresa_id column
 * @method array findByCreatedBy(string $created_by) Return Usuario objects filtered by the created_by column
 * @method array findByUpdatedBy(string $updated_by) Return Usuario objects filtered by the updated_by column
 * @method array findByCreatedAt(string $created_at) Return Usuario objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Usuario objects filtered by the updated_at column
 */
abstract class BaseUsuarioQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseUsuarioQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'default';
        }
        if (null === $modelName) {
            $modelName = 'Metapod\\SoporteBundle\\Model\\Usuario';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new UsuarioQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   UsuarioQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return UsuarioQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof UsuarioQuery) {
            return $criteria;
        }
        $query = new UsuarioQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Usuario|Usuario[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UsuarioPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Usuario A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Usuario A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `nombre`, `email`, `salt`, `apellido`, `username`, `password`, `direccion`, `fecha_nacimiento`, `ultimo_cambio_password`, `estado_usuario_id`, `record_password`, `avatar`, `conectado`, `ultima_ip`, `empresa_id`, `created_by`, `updated_by`, `created_at`, `updated_at` FROM `usuario` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Usuario();
            $obj->hydrate($row);
            UsuarioPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Usuario|Usuario[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Usuario[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsuarioPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsuarioPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UsuarioPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsuarioPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByNombre('fooValue');   // WHERE nombre = 'fooValue'
     * $query->filterByNombre('%fooValue%'); // WHERE nombre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByNombre($nombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombre)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombre)) {
                $nombre = str_replace('*', '%', $nombre);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::NOMBRE, $nombre, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the salt column
     *
     * Example usage:
     * <code>
     * $query->filterBySalt('fooValue');   // WHERE salt = 'fooValue'
     * $query->filterBySalt('%fooValue%'); // WHERE salt LIKE '%fooValue%'
     * </code>
     *
     * @param     string $salt The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterBySalt($salt = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($salt)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $salt)) {
                $salt = str_replace('*', '%', $salt);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::SALT, $salt, $comparison);
    }

    /**
     * Filter the query on the apellido column
     *
     * Example usage:
     * <code>
     * $query->filterByApellido('fooValue');   // WHERE apellido = 'fooValue'
     * $query->filterByApellido('%fooValue%'); // WHERE apellido LIKE '%fooValue%'
     * </code>
     *
     * @param     string $apellido The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByApellido($apellido = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($apellido)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $apellido)) {
                $apellido = str_replace('*', '%', $apellido);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::APELLIDO, $apellido, $comparison);
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
     * $query->filterByUsername('%fooValue%'); // WHERE username LIKE '%fooValue%'
     * </code>
     *
     * @param     string $username The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByUsername($username = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $username)) {
                $username = str_replace('*', '%', $username);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::USERNAME, $username, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%'); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $password)) {
                $password = str_replace('*', '%', $password);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the direccion column
     *
     * Example usage:
     * <code>
     * $query->filterByDireccion('fooValue');   // WHERE direccion = 'fooValue'
     * $query->filterByDireccion('%fooValue%'); // WHERE direccion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $direccion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByDireccion($direccion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($direccion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $direccion)) {
                $direccion = str_replace('*', '%', $direccion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::DIRECCION, $direccion, $comparison);
    }

    /**
     * Filter the query on the fecha_nacimiento column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaNacimiento('2011-03-14'); // WHERE fecha_nacimiento = '2011-03-14'
     * $query->filterByFechaNacimiento('now'); // WHERE fecha_nacimiento = '2011-03-14'
     * $query->filterByFechaNacimiento(array('max' => 'yesterday')); // WHERE fecha_nacimiento < '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaNacimiento The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByFechaNacimiento($fechaNacimiento = null, $comparison = null)
    {
        if (is_array($fechaNacimiento)) {
            $useMinMax = false;
            if (isset($fechaNacimiento['min'])) {
                $this->addUsingAlias(UsuarioPeer::FECHA_NACIMIENTO, $fechaNacimiento['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaNacimiento['max'])) {
                $this->addUsingAlias(UsuarioPeer::FECHA_NACIMIENTO, $fechaNacimiento['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::FECHA_NACIMIENTO, $fechaNacimiento, $comparison);
    }

    /**
     * Filter the query on the ultimo_cambio_password column
     *
     * Example usage:
     * <code>
     * $query->filterByUltimoCambioPassword('2011-03-14'); // WHERE ultimo_cambio_password = '2011-03-14'
     * $query->filterByUltimoCambioPassword('now'); // WHERE ultimo_cambio_password = '2011-03-14'
     * $query->filterByUltimoCambioPassword(array('max' => 'yesterday')); // WHERE ultimo_cambio_password < '2011-03-13'
     * </code>
     *
     * @param     mixed $ultimoCambioPassword The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByUltimoCambioPassword($ultimoCambioPassword = null, $comparison = null)
    {
        if (is_array($ultimoCambioPassword)) {
            $useMinMax = false;
            if (isset($ultimoCambioPassword['min'])) {
                $this->addUsingAlias(UsuarioPeer::ULTIMO_CAMBIO_PASSWORD, $ultimoCambioPassword['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ultimoCambioPassword['max'])) {
                $this->addUsingAlias(UsuarioPeer::ULTIMO_CAMBIO_PASSWORD, $ultimoCambioPassword['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::ULTIMO_CAMBIO_PASSWORD, $ultimoCambioPassword, $comparison);
    }

    /**
     * Filter the query on the estado_usuario_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEstadoUsuarioId(1234); // WHERE estado_usuario_id = 1234
     * $query->filterByEstadoUsuarioId(array(12, 34)); // WHERE estado_usuario_id IN (12, 34)
     * $query->filterByEstadoUsuarioId(array('min' => 12)); // WHERE estado_usuario_id >= 12
     * $query->filterByEstadoUsuarioId(array('max' => 12)); // WHERE estado_usuario_id <= 12
     * </code>
     *
     * @see       filterByEstadoUsuario()
     *
     * @param     mixed $estadoUsuarioId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByEstadoUsuarioId($estadoUsuarioId = null, $comparison = null)
    {
        if (is_array($estadoUsuarioId)) {
            $useMinMax = false;
            if (isset($estadoUsuarioId['min'])) {
                $this->addUsingAlias(UsuarioPeer::ESTADO_USUARIO_ID, $estadoUsuarioId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($estadoUsuarioId['max'])) {
                $this->addUsingAlias(UsuarioPeer::ESTADO_USUARIO_ID, $estadoUsuarioId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::ESTADO_USUARIO_ID, $estadoUsuarioId, $comparison);
    }

    /**
     * Filter the query on the record_password column
     *
     * Example usage:
     * <code>
     * $query->filterByRecordPassword('fooValue');   // WHERE record_password = 'fooValue'
     * $query->filterByRecordPassword('%fooValue%'); // WHERE record_password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $recordPassword The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByRecordPassword($recordPassword = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($recordPassword)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $recordPassword)) {
                $recordPassword = str_replace('*', '%', $recordPassword);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::RECORD_PASSWORD, $recordPassword, $comparison);
    }

    /**
     * Filter the query on the avatar column
     *
     * Example usage:
     * <code>
     * $query->filterByAvatar('fooValue');   // WHERE avatar = 'fooValue'
     * $query->filterByAvatar('%fooValue%'); // WHERE avatar LIKE '%fooValue%'
     * </code>
     *
     * @param     string $avatar The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByAvatar($avatar = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($avatar)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $avatar)) {
                $avatar = str_replace('*', '%', $avatar);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::AVATAR, $avatar, $comparison);
    }

    /**
     * Filter the query on the conectado column
     *
     * Example usage:
     * <code>
     * $query->filterByConectado(true); // WHERE conectado = true
     * $query->filterByConectado('yes'); // WHERE conectado = true
     * </code>
     *
     * @param     boolean|string $conectado The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByConectado($conectado = null, $comparison = null)
    {
        if (is_string($conectado)) {
            $conectado = in_array(strtolower($conectado), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UsuarioPeer::CONECTADO, $conectado, $comparison);
    }

    /**
     * Filter the query on the ultima_ip column
     *
     * Example usage:
     * <code>
     * $query->filterByUltimaIp('fooValue');   // WHERE ultima_ip = 'fooValue'
     * $query->filterByUltimaIp('%fooValue%'); // WHERE ultima_ip LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ultimaIp The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByUltimaIp($ultimaIp = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ultimaIp)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ultimaIp)) {
                $ultimaIp = str_replace('*', '%', $ultimaIp);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::ULTIMA_IP, $ultimaIp, $comparison);
    }

    /**
     * Filter the query on the empresa_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpresaId(1234); // WHERE empresa_id = 1234
     * $query->filterByEmpresaId(array(12, 34)); // WHERE empresa_id IN (12, 34)
     * $query->filterByEmpresaId(array('min' => 12)); // WHERE empresa_id >= 12
     * $query->filterByEmpresaId(array('max' => 12)); // WHERE empresa_id <= 12
     * </code>
     *
     * @param     mixed $empresaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByEmpresaId($empresaId = null, $comparison = null)
    {
        if (is_array($empresaId)) {
            $useMinMax = false;
            if (isset($empresaId['min'])) {
                $this->addUsingAlias(UsuarioPeer::EMPRESA_ID, $empresaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($empresaId['max'])) {
                $this->addUsingAlias(UsuarioPeer::EMPRESA_ID, $empresaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::EMPRESA_ID, $empresaId, $comparison);
    }

    /**
     * Filter the query on the created_by column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedBy('fooValue');   // WHERE created_by = 'fooValue'
     * $query->filterByCreatedBy('%fooValue%'); // WHERE created_by LIKE '%fooValue%'
     * </code>
     *
     * @param     string $createdBy The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByCreatedBy($createdBy = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($createdBy)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $createdBy)) {
                $createdBy = str_replace('*', '%', $createdBy);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::CREATED_BY, $createdBy, $comparison);
    }

    /**
     * Filter the query on the updated_by column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedBy('fooValue');   // WHERE updated_by = 'fooValue'
     * $query->filterByUpdatedBy('%fooValue%'); // WHERE updated_by LIKE '%fooValue%'
     * </code>
     *
     * @param     string $updatedBy The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByUpdatedBy($updatedBy = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($updatedBy)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $updatedBy)) {
                $updatedBy = str_replace('*', '%', $updatedBy);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::UPDATED_BY, $updatedBy, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at < '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(UsuarioPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(UsuarioPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at < '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(UsuarioPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UsuarioPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related EstadoUsuario object
     *
     * @param   EstadoUsuario|PropelObjectCollection $estadoUsuario The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UsuarioQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByEstadoUsuario($estadoUsuario, $comparison = null)
    {
        if ($estadoUsuario instanceof EstadoUsuario) {
            return $this
                ->addUsingAlias(UsuarioPeer::ESTADO_USUARIO_ID, $estadoUsuario->getId(), $comparison);
        } elseif ($estadoUsuario instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UsuarioPeer::ESTADO_USUARIO_ID, $estadoUsuario->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByEstadoUsuario() only accepts arguments of type EstadoUsuario or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EstadoUsuario relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function joinEstadoUsuario($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EstadoUsuario');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'EstadoUsuario');
        }

        return $this;
    }

    /**
     * Use the EstadoUsuario relation EstadoUsuario object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Metapod\SoporteBundle\Model\EstadoUsuarioQuery A secondary query class using the current class as primary query
     */
    public function useEstadoUsuarioQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEstadoUsuario($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EstadoUsuario', '\Metapod\SoporteBundle\Model\EstadoUsuarioQuery');
    }

    /**
     * Filter the query by a related Bitacora object
     *
     * @param   Bitacora|PropelObjectCollection $bitacora  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UsuarioQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBitacora($bitacora, $comparison = null)
    {
        if ($bitacora instanceof Bitacora) {
            return $this
                ->addUsingAlias(UsuarioPeer::ID, $bitacora->getUsuarioId(), $comparison);
        } elseif ($bitacora instanceof PropelObjectCollection) {
            return $this
                ->useBitacoraQuery()
                ->filterByPrimaryKeys($bitacora->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBitacora() only accepts arguments of type Bitacora or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Bitacora relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function joinBitacora($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Bitacora');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Bitacora');
        }

        return $this;
    }

    /**
     * Use the Bitacora relation Bitacora object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Metapod\SoporteBundle\Model\BitacoraQuery A secondary query class using the current class as primary query
     */
    public function useBitacoraQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBitacora($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Bitacora', '\Metapod\SoporteBundle\Model\BitacoraQuery');
    }

    /**
     * Filter the query by a related UsuarioPerfil object
     *
     * @param   UsuarioPerfil|PropelObjectCollection $usuarioPerfil  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UsuarioQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUsuarioPerfil($usuarioPerfil, $comparison = null)
    {
        if ($usuarioPerfil instanceof UsuarioPerfil) {
            return $this
                ->addUsingAlias(UsuarioPeer::ID, $usuarioPerfil->getUsuarioId(), $comparison);
        } elseif ($usuarioPerfil instanceof PropelObjectCollection) {
            return $this
                ->useUsuarioPerfilQuery()
                ->filterByPrimaryKeys($usuarioPerfil->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUsuarioPerfil() only accepts arguments of type UsuarioPerfil or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UsuarioPerfil relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function joinUsuarioPerfil($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UsuarioPerfil');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'UsuarioPerfil');
        }

        return $this;
    }

    /**
     * Use the UsuarioPerfil relation UsuarioPerfil object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Metapod\SoporteBundle\Model\UsuarioPerfilQuery A secondary query class using the current class as primary query
     */
    public function useUsuarioPerfilQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsuarioPerfil($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsuarioPerfil', '\Metapod\SoporteBundle\Model\UsuarioPerfilQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Usuario $usuario Object to remove from the list of results
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function prune($usuario = null)
    {
        if ($usuario) {
            $this->addUsingAlias(UsuarioPeer::ID, $usuario->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     UsuarioQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(UsuarioPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     UsuarioQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(UsuarioPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     UsuarioQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(UsuarioPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     UsuarioQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(UsuarioPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     UsuarioQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(UsuarioPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     UsuarioQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(UsuarioPeer::CREATED_AT);
    }
}
