<?php



/**
 * This class defines the structure of the 'customers' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.pizzaService.map
 */
class CustomerTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'pizzaService.map.CustomerTableMap';

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
        $this->setName('customers');
        $this->setPhpName('Customer');
        $this->setClassname('Customer');
        $this->setPackage('pizzaService');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('firstname', 'Firstname', 'VARCHAR', true, 255, null);
        $this->addColumn('lastname', 'Lastname', 'VARCHAR', true, 255, null);
        $this->addColumn('zip', 'Zip', 'INTEGER', true, null, null);
        $this->addColumn('city', 'City', 'VARCHAR', true, 255, null);
        $this->addColumn('country', 'Country', 'VARCHAR', true, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Order', 'Order', RelationMap::ONE_TO_MANY, array('id' => 'customers_id', ), null, null, 'Orders');
    } // buildRelations()

} // CustomerTableMap
