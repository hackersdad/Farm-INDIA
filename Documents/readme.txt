**************************************
This Contains All the documents.
**************************************

This is about the database schema, as the schema once fixed needs to remain the same, thus it's needed to discuss it as much as
possible.

The databse named Farm_INDIA consists of the following tables: /// all the tables are described below
	* User - For the user comprising of the customers, traders, farmers and us.
	* login_tokens - containing the cookies meant for authorising the user.
	* products - containing the product details.
	* inventory_history - contaning all inventory related history
	* live_stock - containing the real time members of the shelve
	* transaction - containing all the details of the transaction
	* feedback - containing all related to the feedback or complaint
	* customers - containing all the details about the customers
	* traders - containing all the details about the traders involved
	* staff - contaning details of the staff
	* invoice - containing all the details of the invoices generated

Individual table have the following fields:

1.User:-
	* id - A unique id for each unique user
	* name
	* UserName
	* email
	* contact number
	* postal_address
	* role - whether customer/ trader/ staff or farmer
	* passsword

2. login_tokens:-
	* id
	* cookie

3. products
	* id - unique id for each product
	* title
	* description
	* picture
	* packages

4. inventory_history
	* Batch_no - unique identifier for each product //primary key
	* product_id - id from product table
	* lot_no - to record the number of lots in each batch
	* provider - Farmer_id / Trader_id
	* Time_in - Time for occupying
	* Total_stock - Providing details for full stock, total capacity at the time of purchase or input, it can be weight too
	* Time_out - time forf dispatch
	* Transaction_in - Transaction id for input
	* Transaction_out - Transaction id for output
	*

5. live_stock:
	* Batch_no - the batch present on the shelve
	* lot_no - the lot remaining from the batch
	* time_out

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
	*id - unique feedback id
	*feedback_text - feedback/complaint provided  //what do you say?
	*issue_status - solved/unsolved

6. Customer
	* Customer_id
	* user_id - from users table
	* banking_details //left undisclosed as the banking details are dependent on the payment interface
	* no_of_orders - increments by one after every order placed
	* total_amount_of_payments - to classify the customers based on their loyality
	* total_number_of_returns
	* feedback_id - id from feedback table, to keep track of the issue, whether solved or not.

7. Trader
	* banking details
	* total orders provided
