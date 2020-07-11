**************************************
This Contains All the documents.
**************************************

This is about the database schema, as the schema once fixed needs to remain the same, thus it's needed to discuss it as much as 
possible.

The databse named Farm_INDIA consists of the following tables:
	* User - For the user comprising of the customers, traders, farmers and us.
	* login_tokens - containing the cookies meant for authorising the user.
	* products - containing the product details.
	* transaction - containing all the details of the transaction 
	* feedback - containing all related to the feedback or complaint
	* inventory - contaning all the real time inventory related data
	* customers - containing all the details about the customers
	* traders - containing all the details about the traders involved
	* employee - contaning details of the employee
	* invoice - containing all the details of the invoices generated

Individual table have the following fields:

1.User:-
	* id - A unique id for each unique user
	* name
	* UserName
	* email 
	* contact number
	* role - whether customer/ trader/ employee or farmer
	* passsword

2. login_tokens:-
	* id
	* cookie

3. products
	* id - unique id for each product
	* title
	* description
	* pic
	* price
	* packages
	* origin - self/ outsourced(trader_id)
	* timing - of occupying
	* lot_no

4. transaaction
	* id - unique id for each transaction
	* userId - user id of the person involved
	* time
	* date
	* type - credit/debit
	* bankid - banking transection id
	* amount
	* invoice_id - id of the invoice

5. feedback

6. Customer
	* Customer id
	* user id
	* banking details
	* no. of orders
	* total amout of payments
	* total number of returns
	* feedback id

7. Trader
	* banking details
	* total orders provided
	* 
