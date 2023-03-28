<?php
namespace Pizzaservice\cli\commands;

use PizzaService\Propel\Models\Ingredient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

/**
 * Implementation of a command where the user is going to be asked to create new ingredient values which are going to be
 * included into the ingredient-table of the pizzaService-database.
 */
class CreateIngredientCommand extends Command
{
    protected static $defaultName = "create:ingredient";

    /**
     * Configuration of additional instances.
     *
     * A description about the function of the command.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setDescription("Sets new ingredient values which are going to be included into the ingredient-table\n");
    }

    /**
     * Creates and includes new ingredient values into the ingredient-table.
     *
     * The user is going to be asked about new ingredient values which are going to be included inside
     * ingredient-table after the confirmation question was confirmed.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \PropelException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //Input for new ingredient values
        $helper = $this->getHelper("question");

        $inputIngredientName = $helper->ask($input, $output, new Question("Please enter the name of the new ingredient: \n"));

        $output->writeln("Following new ingredients were detected: $inputIngredientName \n");

        $question = new ConfirmationQuestion("Do you want to save the new ingredient?", false, "/^(y|j)/i");

        if (!$helper->ask($input, $output, $question))
        {
            $output->writeln("Ok, no changes are made to the database.\n");
            return command::SUCCESS;
        }

        //Sets the new ingredient values
        $ingredient = new Ingredient();
        $ingredient->setName($inputIngredientName);

        //Includes the new ingredient values into the ingredient-table
        $ingredient->save();

        $output->writeln("The ingredient was added to the database successfully\n");

        return Command::SUCCESS;
    }
}

