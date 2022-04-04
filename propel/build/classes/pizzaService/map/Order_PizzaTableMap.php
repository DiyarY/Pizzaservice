<?php



/**
 * This class defines the structure of the 'order_pizzas' table.
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
class Order_PizzaTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'pizzaService.map.Order_PizzaTableMap';

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
        $this->setName('order_pizzas');
        $this->setPhpName('Order_Pizza');
        $this->setClassname('Order_Pizza');
        $this->setPackage('pizzaService');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('orders_id', 'OrdersId', 'INTEGER' , 'orders', 'id', true, null, null);
        $this->addForeignPrimaryKey('pizzas_id', 'PizzasId', 'INTEGER' , 'pizzas', 'id', true, null, null);
        $this->addColumn('amount', 'Amount', 'FLOAT', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Order', 'Order', RelationMap::MANY_TO_ONE, array('orders_id' => 'id', ), null, null);
        $this->addRelation('Pizza', 'Pizza', RelationMap::MANY_TO_ONE, array('pizzas_id' => 'id', ), null, null);
    } // buildRelations()

} // Order_PizzaTableMap
