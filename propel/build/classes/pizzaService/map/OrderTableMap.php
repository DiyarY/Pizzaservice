<?php



/**
 * This class defines the structure of the 'orders' table.
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
class OrderTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'pizzaService.map.OrderTableMap';

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
        $this->setName('orders');
        $this->setPhpName('Order');
        $this->setClassname('Order');
        $this->setPackage('pizzaService');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('customers_id', 'CustomersId', 'INTEGER', 'customers', 'id', true, null, null);
        $this->addColumn('total', 'Total', 'FLOAT', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'DATE', true, null, null);
        $this->addColumn('completed_at', 'CompletedAt', 'TIME', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Customer', 'Customer', RelationMap::MANY_TO_ONE, array('customers_id' => 'id', ), null, null);
        $this->addRelation('Order_Pizza', 'Order_Pizza', RelationMap::ONE_TO_MANY, array('id' => 'orders_id', ), null, null, 'Order_Pizzas');
        $this->addRelation('Pizza', 'Pizza', RelationMap::MANY_TO_MANY, array(), null, null, 'Pizzas');
    } // buildRelations()

} // OrderTableMap
