<?php



/**
 * This class defines the structure of the 'pizzas' table.
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
class PizzaTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'pizzaService.map.PizzaTableMap';

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
        $this->setName('pizzas');
        $this->setPhpName('Pizza');
        $this->setClassname('Pizza');
        $this->setPackage('pizzaService');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 120, null);
        $this->addColumn('price', 'Price', 'FLOAT', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Ingredient_pizza', 'Ingredient_pizza', RelationMap::ONE_TO_MANY, array('id' => 'pizzas_id', ), null, null, 'Ingredient_pizzas');
        $this->addRelation('Order_Pizza', 'Order_Pizza', RelationMap::ONE_TO_MANY, array('id' => 'pizzas_id', ), null, null, 'Order_Pizzas');
        $this->addRelation('Ingredient', 'Ingredient', RelationMap::MANY_TO_MANY, array(), null, null, 'Ingredients');
        $this->addRelation('Order', 'Order', RelationMap::MANY_TO_MANY, array(), null, null, 'Orders');
    } // buildRelations()

} // PizzaTableMap
