<?php

namespace Pizzaservice\Cli\Commands;

use Pizzaservice\Propel\Models\Pizza;
use Pizzaservice\Propel\Models\PizzaIngredient;
use Pizzaservice\Propel\Models\PizzaQuery;
use Pizzaservice\Propel\Models\IngredientQuery;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

/**
 * Implementation of a command where the user is going to be asked about new pizza-values which are going to be included
 * into the pizza-table of the pizzaService-database.
 *
 * @class CreatePizzaCommand
 */
class CreatePizzaCommand extends Command
{
        protected static $defaultName = "create:pizza";

    /**
     * Configure additional instances.
     *
     * A description about the function of the command.
     *
     * @return void
     */
        protected function configure()
        {
            $this->setDescription("Sets the new pizza values which are going to be included inside the pizza-table.\n");
        }

    /**
     * Creates and includes the new pizza with the chosen ingredients into the pizza-table.
     *
     * The user is going to be asked about new pizza values which are going to be included inside
     * pizza-table after the confirmation question was confirmed.
     *
     * @param InputInterface $_input
     * @param OutputInterface $_output
     * @return int
     * @throws \PropelException
     */
        protected function execute(InputInterface $_input, OutputInterface $_output)
        {
            //Initialize the existing pizzas
            $pizzas = PizzaQuery::create()->find();

            $_output->writeln("Following pizzas are already available:");

            foreach ($pizzas as $pizza)
            {
                //Shows all available pizzas
                $_output->writeln("\n- ".$pizza->getName()." is already defined and consists of following ingredients:");

                foreach ($pizza->getPizzaIngredients() as $pizzaIngredient)
                {
                    if ($pizzaIngredient)
                    {
                        $ingredient = $pizzaIngredient->getIngredient();
                        //Lists the ingredients of an already defined pizza
                        $_output->writeln("\t"."-> ".$ingredient->getName());
                    }
                }
            }

            //Input for new pizza values
            $helper = $this->getHelper("question");

            $question = new Question("\nPlease enter the name of the new pizza: \n");
            $inputPizzaName = $helper->ask($_input, $_output, $question);

            //Initialize and filters only the attributes of the name-column
            $uniquePizzaNames = PizzaQuery::create()
                ->filterByName($inputPizzaName)
                ->findOne();

            if ($uniquePizzaNames)
            {
                //Checks whether an entry with that property exists
                $_output->writeln($inputPizzaName . " does already exist!");
                return false;
            }

            $question = new Question("Please enter the price for the new pizza: \n");
            $inputPizzaPrice =  str_replace(",", ".", $helper->ask($_input, $_output, $question));

            $_output->writeln("Following specified data were detected: $inputPizzaName, $inputPizzaPrice \n");

            //Initialize all columns of the ingredient-table
            $ingredients = IngredientQuery::create()->find();
            $listOfIngredients = [];

            foreach ($ingredients as $ingredient)
                {
                    //Shows only the values of the name-columns inside the ingredient-table
                    $listOfIngredients[] = $ingredient->getName();
                }

            //Input of a list of ingredients
            $question = new ChoiceQuestion("Please enter the ingredients for the pizza: ", $listOfIngredients);
            $question->setMultiselect(true);
            $inputIngredients = $helper->ask($_input, $_output, $question);

            //Ingredients must be seperated by a comma
            $_output->writeln("You have chosen following ingredients: ". implode(", ", $inputIngredients));

            $question = new ConfirmationQuestion("Do you want to save and include the new specified data into the pizza-table?", false, "/^(y|j)/i");

            if (!$helper->ask($_input, $_output, $question))
            {
                $_output->writeln("The new specified data for the pizza will be deleted now \n");
                return command::SUCCESS;
            }

            //Sets the new pizza-values
            $pizza = new Pizza();
            $pizza->setName($inputPizzaName);
            $pizza->setPrice($inputPizzaPrice);

            foreach ($inputIngredients as $inputIngredient)
            {
                if ($ingredient) $pizza->addIngredient($ingredient);
                else {
                    //Checks whether an entry with that property exists
                    $_output->writeln("Cannot find ingredient with name $inputIngredient in database!");
                    return false;
                }
            }

            //Includes the new pizza values into pizza-table
            $pizza->save();

            $_output->writeln("The new specified pizza were included inside the pizza-table.\n");

            return Command::SUCCESS;
        }
}