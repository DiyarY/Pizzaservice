<?php



/**
 * This class defines the structure of the 'pizza_ingredients' table.
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
class Ingredient_pizzaTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'pizzaService.map.Ingredient_pizzaTableMap';

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
        $this->setName('pizza_ingredients');
        $this->setPhpName('Ingredient_pizza');
        $this->setClassname('Ingredient_pizza');
        $this->setPackage('pizzaService');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('ingredients_id', 'IngredientsId', 'INTEGER' , 'ingredients', 'id', true, null, null);
        $this->addForeignPrimaryKey('pizzas_id', 'PizzasId', 'INTEGER' , 'pizzas', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Ingredient', 'Ingredient', RelationMap::MANY_TO_ONE, array('ingredients_id' => 'id', ), null, null);
        $this->addRelation('Pizza', 'Pizza', RelationMap::MANY_TO_ONE, array('pizzas_id' => 'id', ), null, null);
    } // buildRelations()

} // Ingredient_pizzaTableMap
