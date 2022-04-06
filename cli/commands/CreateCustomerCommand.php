<?php
namespace Pizzaservice\cli\commands;

use Customer;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Question\ConfirmationQuestion;

/**
 * Implementation of a command where the user is going to be asked to create new customer values to include them into the
 * customer-table of the pizzaService-database.
 *
 * @class CreateCustomerCommand
 */
class CreateCustomerCommand extends Command
{
    protected static $defaultName = "create:customer";

    /**
     * Configuration of additional instances.
     *
     * A description about the function of the command.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setDescription("Sets new customer vales which are going to be included into the customer-table.\n");
    }

    /**
     * Creates and includes new customer values into the customer-table.
     *
     * The user is going to be asked about new values for the customer which are going to be included inside
     * customer-table after the confirmation question was confirmed.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     * @throws \PropelException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper("question");

        //Input for new customer values
        $question = new Question("Please enter the first name of the new customer: \n");
        $inputCustomerFirstName = $helper->ask($input, $output, $question);

        $question = new Question("Please enter the last name of of the new customer: \n");
        $inputCustomerLastName = $helper->ask($input, $output, $question);

        $question = new Question("Please enter the zip of the new Customer: \n");
        $inputCustomerZip = $helper->ask($input , $output, $question);

        $question = new Question("Where does the new customer live\n");
        $inputCustomerCity = $helper->ask($input, $output, $question);

        $question = new Question("In which country does the new customer live\n");
        $inputCustomerCountry = $helper->ask($input, $output, $question);

        echo "Following new customer verifications were detected: $inputCustomerFirstName, $inputCustomerLastName, $inputCustomerZip, $inputCustomerCity, $inputCustomerCountry\n";

        //Confirms the new customer values
        $question = new ConfirmationQuestion("Do you want to save the new detected customer verifications", false, "/^(y|j)/i");

        if (!$helper->ask($input, $output, $question))
        {
            echo "The specified data of the customer will be deleted now\n";
            return command::SUCCESS;
        }

        //Sets the new customer values
        $customer = new Customer();
        $customer->setFirstname($inputCustomerFirstName);
        $customer->setLastname($inputCustomerLastName);
        $customer->setZip($inputCustomerZip);
        $customer->setCity($inputCustomerCity);
        $customer->setCountry($inputCustomerCountry);

        //Includes the new customer values into the customer-table
        $customer->save();

        echo "The new customer-verification is included inside the customer-table\n";

        return Command::SUCCESS;
    }
}