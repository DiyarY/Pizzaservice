# Pizzaservice

___

## Project information

This project serves as a beginner project to get familiar with the use of Propel. <br><br>

In short, the Pizzaservice-project contains a database that was implemented after a relational-database schema <br>
and provides an amount of defined tables for specified areas which can be compared by those of a small <br>
pizza-service deliver system. The main purpose of this project is to manipulate the Pizzaservice-database <br>
by help of propel.

## Pizzaservice-database schema

**The Pizzaservice-database contains following tables:**

- Pizza
- Ingredient
- Order
- Customer
- Pizza_Ingredient
- Order_Pizza

**Relationship between the tables:**

- Pizza to Ingredient -> many to many 
- Pizza to Order -> many to many 
- Customer to Order -> one to many

## Usage of Propel-commands

An amount of defined propel-commands are provided which can be given over the command-line where <br>
each command provides a functionality to manipulate the database:

>Execution of a command: php pizzatool.php command

**Available commands**:

> create:customer &emsp;&emsp;  -> creates and includes new customer values into the customer-table <br>
> create:ingredient&emsp;&emsp; -> creates and includes new ingredient values into the ingredient-table <br>
> create:order &emsp;&emsp;&emsp;&emsp;-> creates and includes new order values into the order-table <br>
> create:pizza &emsp;&emsp;&emsp;&emsp;-> creates and includes new pizza values into the pizza-table <br>
> list:customer&emsp;&emsp;&emsp;&emsp;-> lists up specified values of the customer-table <br>
> list:ingredient&emsp;&emsp;&emsp;&emsp;-> lists up specified values of the ingredient-table <br>
> list:order&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;-> lists up specified values of the order-table <br>
> list:pizza&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;-> lists up specified values of the pizza-table