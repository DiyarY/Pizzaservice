<?php
namespace Pizzaservice\cli\commands;

use Order;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Command\Command;

/**
 * Implementation of a command where the user is going to be asked to create new order-values which are going to be
 * included into the order-table of the pizzaService-database.
 *
 * @class CreateOrderCommand
 */
class CreateOrderCommand extends Command
{
    protected static $defaultName = "create:order";

    /**
     * Configure additional instances.
     *
     * A description about the function of the command.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setDescription("Sets new order values which are going to be included into the order-table.\n");
    }

    /**
     * Creates and includes new order-values into the order-table.
     *
     * The user is going to be asked about new order values which are going to be included inside
     * order-table after the confirmation question was confirmed.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \PropelException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //Input for new order values
        $helper = $this->getHelper("question");

        $question = new Question("Please enter the total price of the order: \n");
        $inputOrderPrice = $helper->ask($input, $output, $question);

        $question = new Question("Please enter the date of the order-creation: \n");
        $inputOrderCreationDate = $helper->ask($input, $output, $question);

        $question = new Question("Please enter the date when the order was completed: \n");
        $inputOrderCompletionOrder = $helper->ask($input, $output, $question);

        echo "Following new order verifications were detected: $inputOrderPrice, $inputOrderCreationDate, $inputOrderCompletionOrder \n";

        $question = new ConfirmationQuestion("Do you want to save and include the new specified order?", false, "/^(y|j)/i");

        if (!$helper->ask($input, $output, $question))
        {
            echo "The specified data of the customer will be deleted now\n";
            return command::SUCCESS;
        }

        //Sets the new order-values
        $order = new Order();
        $order->setTotal($inputOrderPrice);
        $order->setCreatedAt($inputOrderCreationDate);
        $order->setCompletedAt($inputOrderCompletionOrder);

        //Includes the new order values into the order-table.
        $order->save();

        echo "The new specified order was included into the order-table\n";

        return Command::SUCCESS;
    }
}