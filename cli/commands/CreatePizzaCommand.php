<?php

namespace Pizzaservice\Cli\Commands;

use Pizza;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
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
     * Creates and includes the new pizza values into the pizza-table.
     *
     * The user is going to be asked about new pizza values which are going to be included inside
     * pizza-table after the confirmation question was confirmed.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \PropelException
     */
        protected function execute(InputInterface $input, OutputInterface $output)
        {
            //Input for new pizza values
            $helper = $this->getHelper("question");

            $question = new Question("Please enter the name of the new pizza: \n");
            $inputPizzaName = $helper->ask($input, $output, $question);

            $question = new Question("Please enter the price for the new pizza: \n");
            $inputPizzaPrice = $helper->ask($input, $output, $question);

            echo "Following specified data were detected: $inputPizzaName, $inputPizzaPrice \n";

            $question = new ConfirmationQuestion("Do you want to save and include the new specified data into the pizza-table?", false, "/^(y|j)/i");

            if (!$helper->ask($input, $output, $question))
            {
                echo "The new specified data for the pizza will be deleted now \n";
                return command::SUCCESS;
            }

            //Sets the new pizza-values
            $pizza = new Pizza();
            $pizza->setName($inputPizzaName);
            $pizza->setPrice($inputPizzaPrice);

            //Includes the new pizza values into pizza-table
            $pizza->save();

            echo "The new specified pizza were included inside the pizza-table.\n";

            return Command::SUCCESS;
        }
}