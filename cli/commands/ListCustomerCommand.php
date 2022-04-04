<?php
namespace Pizzaservice\cli\commands;

use Customer;
use CustomerQuery;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;

class ListCustomerCommand extends Command
{
    protected static $defaultName = "list:customer";

    protected function configure()
    {
        $this->setDescription("Lists up all customers from the customer-table");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $customers = CustomerQuery::create()->find();

        echo "Currently there is a total of ".count($customers)." customers";

        foreach ($customers as $customer)
        {
            echo $customer->getName();
        }
    }


}