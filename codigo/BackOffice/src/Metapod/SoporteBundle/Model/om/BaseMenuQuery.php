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
use Metapod\SoporteBundle\Model\Menu;
use Metapod\SoporteBundle\Model\MenuPeer;
use Metapod\SoporteBundle\Model\MenuQuery;
use Metapod\SoporteBundle\Model\PerfilMenu;

/**
 * @method MenuQuery orderById($order = Criteria::ASC) Order by the id column
 * @method MenuQuery orderByNombre($order = Criteria::ASC) Order by the nombre column
 * @method MenuQuery orderByRuta($order = Criteria::ASC) Order by the ruta column
 * @method MenuQuery orderBySuperior($order = Criteria::ASC) Order by the superior column
 * @method MenuQuery orderByMostrar($order = Criteria::ASC) Order by the mostrar column
 * @method MenuQuery orderByIcono($order = Criteria::ASC) Order by the icono column
 * @method MenuQuery orderByCreatedBy($order = Criteria::ASC) Order by the created_by column
 * @method MenuQuery orderByUpdatedBy($order = Criteria::ASC) Order by the updated_by column
 * @method MenuQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method MenuQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method MenuQuery groupById() Group by the id column
 * @method MenuQuery groupByNombre() Group by the nombre column
 * @method MenuQuery groupByRuta() Group by the ruta column
 * @method MenuQuery groupBySuperior() Group by the superior column
 * @method MenuQuery groupByMostrar() Group by the mostrar column
 * @method MenuQuery groupByIcono() Group by the icono column
 * @method MenuQuery groupByCreatedBy() Group by the created_by column
 * @method MenuQuery groupByUpdatedBy() Group by the updated_by column
 * @method MenuQuery groupByCreatedAt() Group by the created_at column
 * @method MenuQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method MenuQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method MenuQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method MenuQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method MenuQuery leftJoinPerfilMenu($relationAlias = null) Adds a LEFT JOIN clause to the query using the PerfilMenu relation
 * @method MenuQuery rightJoinPerfilMenu($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PerfilMenu relation
 * @method MenuQuery innerJoinPerfilMenu($relationAlias = null) Adds a INNER JOIN clause to the query using the PerfilMenu relation
 *
 * @method Menu findOne(PropelPDO $con = null) Return the first Menu matching the query
 * @method Menu findOneOrCreate(PropelPDO $con = null) Return the first Menu matching the query, or a new Menu object populated from the query conditions when no match is found
 *
 * @method Menu findOneByNombre(string $nombre) Return the first Menu filtered by the nombre column
 * @method Menu findOneByRuta(string $ruta) Return the first Menu filtered by the ruta column
 * @method Menu findOneBySuperior(int $superior) Return the first Menu filtered by the superior column
 * @method Menu findOneByMostrar(int $mostrar) Return the first Menu filtered by the mostrar column
 * @method Menu findOneByIcono(string $icono) Return the first Menu filtered by the icono column
 * @method Menu findOneByCreatedBy(string $created_by) Return the first Menu filtered by the created_by column
 * @method Menu findOneByUpdatedBy(string $updated_by) Return the first Menu filtered by the updated_by column
 * @method Menu findOneByCreatedAt(string $created_at) Return the first Menu filtered by the created_at column
 * @method Menu findOneByUpdatedAt(string $updated_at) Return the first Menu filtered by the updated_at column
 *
 * @method array findById(int $id) Return Menu objects filtered by the id column
 * @method array findByNombre(string $nombre) Return Menu objects filtered by the nombre column
 * @method array findByRuta(string $ruta) Return Menu objects filtered by the ruta column
 * @method array findBySuperior(int $superior) Return Menu objects filtered by the superior column
 * @method array findByMostrar(int $mostrar) Return Menu objects filtered by the mostrar column
 * @method array findByIcono(string $icono) Return Menu objects filtered by the icono column
 * @method array findByCreatedBy(string $created_by) Return Menu objects filtered by the created_by column
 * @method array findByUpdatedBy(string $updated_by) Return Menu objects filtered by the updated_by column
 * @method array findByCreatedAt(string $created_at) Return Menu objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Menu objects filtered by the updated_at column
 */
abstract class BaseMenuQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseMenuQuery object.
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
            $modelName = 'Metapod\\SoporteBundle\\Model\\Menu';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new MenuQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   MenuQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return MenuQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MenuQuery) {
            return $criteria;
        }
        $query = new MenuQuery(null, null, $modelAlias);

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
     * @return   Menu|Menu[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MenuPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(MenuPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Menu A model object, or null if the key is not found
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
     * @return                 Menu A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `nombre`, `ruta`, `superior`, `mostrar`, `icono`, `created_by`, `updated_by`, `created_at`, `updated_at` FROM `menu` WHERE `id` = :p0';
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
            $obj = new Menu();
            $obj->hydrate($row);
            MenuPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Menu|Menu[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Menu[]|mixed the list of results, formatted by the current formatter
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
     * @return MenuQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MenuPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return MenuQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MenuPeer::ID, $keys, Criteria::IN);
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
     * @return MenuQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(MenuPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(MenuPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MenuPeer::ID, $id, $comparison);
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
     * @return MenuQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MenuPeer::NOMBRE, $nombre, $comparison);
    }

    /**
     * Filter the query on the ruta column
     *
     * Example usage:
     * <code>
     * $query->filterByRuta('fooValue');   // WHERE ruta = 'fooValue'
     * $query->filterByRuta('%fooValue%'); // WHERE ruta LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ruta The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MenuQuery The current query, for fluid interface
     */
    public function filterByRuta($ruta = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ruta)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ruta)) {
                $ruta = str_replace('*', '%', $ruta);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MenuPeer::RUTA, $ruta, $comparison);
    }

    /**
     * Filter the query on the superior column
     *
     * Example usage:
     * <code>
     * $query->filterBySuperior(1234); // WHERE superior = 1234
     * $query->filterBySuperior(array(12, 34)); // WHERE superior IN (12, 34)
     * $query->filterBySuperior(array('min' => 12)); // WHERE superior >= 12
     * $query->filterBySuperior(array('max' => 12)); // WHERE superior <= 12
     * </code>
     *
     * @param     mixed $superior The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MenuQuery The current query, for fluid interface
     */
    public function filterBySuperior($superior = null, $comparison = null)
    {
        if (is_array($superior)) {
            $useMinMax = false;
            if (isset($superior['min'])) {
                $this->addUsingAlias(MenuPeer::SUPERIOR, $superior['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($superior['max'])) {
                $this->addUsingAlias(MenuPeer::SUPERIOR, $superior['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MenuPeer::SUPERIOR, $superior, $comparison);
    }

    /**
     * Filter the query on the mostrar column
     *
     * Example usage:
     * <code>
     * $query->filterByMostrar(1234); // WHERE mostrar = 1234
     * $query->filterByMostrar(array(12, 34)); // WHERE mostrar IN (12, 34)
     * $query->filterByMostrar(array('min' => 12)); // WHERE mostrar >= 12
     * $query->filterByMostrar(array('max' => 12)); // WHERE mostrar <= 12
     * </code>
     *
     * @param     mixed $mostrar The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MenuQuery The current query, for fluid interface
     */
    public function filterByMostrar($mostrar = null, $comparison = null)
    {
        if (is_array($mostrar)) {
            $useMinMax = false;
            if (isset($mostrar['min'])) {
                $this->addUsingAlias(MenuPeer::MOSTRAR, $mostrar['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mostrar['max'])) {
                $this->addUsingAlias(MenuPeer::MOSTRAR, $mostrar['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MenuPeer::MOSTRAR, $mostrar, $comparison);
    }

    /**
     * Filter the query on the icono column
     *
     * Example usage:
     * <code>
     * $query->filterByIcono('fooValue');   // WHERE icono = 'fooValue'
     * $query->filterByIcono('%fooValue%'); // WHERE icono LIKE '%fooValue%'
     * </code>
     *
     * @param     string $icono The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MenuQuery The current query, for fluid interface
     */
    public function filterByIcono($icono = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($icono)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $icono)) {
                $icono = str_replace('*', '%', $icono);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MenuPeer::ICONO, $icono, $comparison);
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
     * @return MenuQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MenuPeer::CREATED_BY, $createdBy, $comparison);
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
     * @return MenuQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MenuPeer::UPDATED_BY, $updatedBy, $comparison);
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
     * @return MenuQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(MenuPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(MenuPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MenuPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return MenuQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(MenuPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(MenuPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MenuPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related PerfilMenu object
     *
     * @param   PerfilMenu|PropelObjectCollection $perfilMenu  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 MenuQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPerfilMenu($perfilMenu, $comparison = null)
    {
        if ($perfilMenu instanceof PerfilMenu) {
            return $this
                ->addUsingAlias(MenuPeer::ID, $perfilMenu->getMenuId(), $comparison);
        } elseif ($perfilMenu instanceof PropelObjectCollection) {
            return $this
                ->usePerfilMenuQuery()
                ->filterByPrimaryKeys($perfilMenu->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPerfilMenu() only accepts arguments of type PerfilMenu or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PerfilMenu relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return MenuQuery The current query, for fluid interface
     */
    public function joinPerfilMenu($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PerfilMenu');

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
            $this->addJoinObject($join, 'PerfilMenu');
        }

        return $this;
    }

    /**
     * Use the PerfilMenu relation PerfilMenu object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Metapod\SoporteBundle\Model\PerfilMenuQuery A secondary query class using the current class as primary query
     */
    public function usePerfilMenuQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPerfilMenu($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PerfilMenu', '\Metapod\SoporteBundle\Model\PerfilMenuQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Menu $menu Object to remove from the list of results
     *
     * @return MenuQuery The current query, for fluid interface
     */
    public function prune($menu = null)
    {
        if ($menu) {
            $this->addUsingAlias(MenuPeer::ID, $menu->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     MenuQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(MenuPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     MenuQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(MenuPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     MenuQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(MenuPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     MenuQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(MenuPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     MenuQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(MenuPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     MenuQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(MenuPeer::CREATED_AT);
    }
}
