#!/usr/bin/env php
<?php
namespace Pizzaservice\cli\commands;

use Ingredient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Question\ConfirmationQuestion;


class CreateIngredientCommand extends Command
{
    protected static $defaultName = "create:ingredient";

    protected function configure()
    {
        $this->setDescription("Creates new user individual ingredients and includes them into the ingredient-table as new value");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper("question");

        $question = new Question("Please enter the name of the new ingredient: \n");
        $inputIngredientName = $helper->ask($input, $output, $question);

        echo "Following new ingredients were detected: $inputIngredientName \n";

        $question = new ConfirmationQuestion("Do you want to save the new detected ingredient name inside the ingredient-table?", false, "/^(y|j)/i");

        if (!$helper->ask($input, $output, $question))
        {
            echo "The new specified data about the ingredient name will be deleted now\n";
            return command::SUCCESS;
        }

        $ingredient = new Ingredient();
        $ingredient->setName($inputIngredientName);

        $ingredient->save();

        echo "The new specified ingredient name were be included inside the ingredient-table";
    }
}

