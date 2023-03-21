<?php

namespace Pizzaservice\Cli\Commands;

use PizzaService\Propel\Models\Pizza;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

/**
 * Implementation of a command where the user is going to be asked about new pizza-values which are going to be included
 * into the pizza-table of the pizzaService-database.
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

            $inputPizzaName = $helper->ask($input, $output, new Question("Please enter the name of the new pizza: \n"));

            $inputPizzaPrice = $helper->ask($input, $output, new Question("Please enter the price for the new pizza: \n"));

            $output->writeln("Following specified data were detected: $inputPizzaName, $inputPizzaPrice \n");

            $question = new ConfirmationQuestion("Do you want to save the new pizza?", false, "/^(y|j)/i");

            if (!$helper->ask($input, $output, $question))
            {
                $output->writeln("Ok, no changes are made to the database.\n");
                return command::SUCCESS;
            }

            //Sets the new pizza-values
            $pizza = new Pizza();
            $pizza->setName($inputPizzaName);
            $pizza->setPrice($inputPizzaPrice);

            //Includes the new pizza values into pizza-table
            $pizza->save();

            $output->writeln("The new pizza was added to the database successfully.\n");

            return Command::SUCCESS;
        }
}