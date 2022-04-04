<?php



/**
 * This class defines the structure of the 'ingredients' table.
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
class IngredientTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'pizzaService.map.IngredientTableMap';

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
        $this->setName('ingredients');
        $this->setPhpName('Ingredient');
        $this->setClassname('Ingredient');
        $this->setPackage('pizzaService');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 120, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Ingredient_pizza', 'Ingredient_pizza', RelationMap::ONE_TO_MANY, array('id' => 'ingredients_id', ), null, null, 'Ingredient_pizzas');
        $this->addRelation('Pizza', 'Pizza', RelationMap::MANY_TO_MANY, array(), null, null, 'Pizzas');
    } // buildRelations()

} // IngredientTableMap
