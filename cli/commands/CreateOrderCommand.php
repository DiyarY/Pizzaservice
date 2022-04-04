<?php
namespace Pizzaservice\cli\commands;

use Order;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Command\Command;

class CreateOrderCommand extends Command
{
    protected static $defaultName = "create:order";

    protected function configure()
    {
        $this->setDescription("Creates a new order with its associated values");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
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

        $order = new Order();
        $order->setTotal($inputOrderPrice);
        $order->setCreatedAt($inputOrderCreationDate);
        $order->setCompletedAt($inputOrderCompletionOrder);

        $order->save();

        echo "The new specified order was included into the order-table";
    }
}