<?php

namespace Pizzaservice\Cli\Commands;
require_once "setup.php";

use Pizza;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

class CreatePizzaCommand extends Command
{
        //Name of the command
        protected static $defaultName = "row:create-pizza";

        protected function configure()
        {
            //Configure the commands
            $this->setDescription("Creates a new pizza with its associated values.");
        }

        protected function execute(InputInterface $input, OutputInterface $output)
        {
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

            $pizza = new Pizza();
            $pizza->setName($inputPizzaName);
            $pizza->setPrice($inputPizzaPrice);

            $pizza->save();

            echo "The new specified pizza were included inside the pizza-table.";
        }
}