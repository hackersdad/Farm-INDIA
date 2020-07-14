**************************************
This Contains All the documents.
**************************************
As the basic problem we tried to solve was the inconsistency and lack of transparency in the supply chain.
To counter this problem we have came up with the idea of using qr code as an unique identifier for each package we produce.
And these qr codes would be linked with the url specifying the product id of that specific product,
thus enabling even the end consumer to track the full history of the product he/she is using.
To successfullyenable this we have to carefully design the database.
This is about the database schema, as the schema once fixed needs to remain the same,
thus it's needs optimisation as much as possible. Every type of suggestion are welcomed

The databse named Farm_INDIA consists of the following tables: //followig are the table names
	* User - For the user comprising of the customers, traders, farmers and us.
	* login_tokens - containing the cookies meant for authorising the user.
	* products - containing the product details.
	* inventory_history - contaning all inventory related history
	* package_history - containing the records of all the packages ever made by us
	* transaction - containing all the details of the transaction
	* feedback - containing all related to the feedback or complaint provided by the customer
	* invoice - containing all the details of the invoices generated

Individual table have the following fields:

1.User:-
	* id - A unique id for each unique user
	* name
	* UserName
	* email
	* contact_number
	* postal_address
	* role - whether customer/ trader/ staff or farmer
	* password
	* feedback_id - id from feedback
	* complaint - id from complaint
	* banking_details //details yet to be decided
	* transaction_id - from transaction table

2. login_tokens:-
	* id
	* cookie

3. products
	* id - unique id for each product
	* title
	* description
	* picture
	* packages_available

4. inventory_history
	* Batch_no - unique identifier for each product //primary key
	* product_id - id from product table
	* provider - user_id to uniquely identify whether provided by farmer or trader by using id from user table
	* Date_Time_in - Date and Time of occupying
	* Volume - the total weightage or volume of the batch recieved /// better column name is required///
	* Transaction_in - Transaction id for input

5. package_history
	* package_id - unique identifier for each product
	* Batch_no - Batch_no from inventory_history to identify the intake time
	* Date_Time_in - date and time when under taken at any facility
	* former_status - whether just produced/out from storage facilty/in transition /out for delivery
	* Date_Time_out - date and time when dispatched
	* after_status - stored at storage/recieved at distribution center/ in transition/ delivered

6. transaaction
	* id - unique id for each transaction
	* userId - user id of the person involved
	* Date_time - date ant time of transaction
	* type - net banking/ debit or credit card/upi ///further details are awaited as payment interface not yet setup
	* bankid - banking transection id
	* amount
	* invoice_id - id of the invoice

7. feedback
	* id - unique feedback id
	* feedback_text - feedback text
	* reply - reply text

8. complaint
	* id - unique id for each complaint
	* issue - textual data
	* media - path for other media submitted
	* status - solved/unsolved
	* action_taken

9. invoice
	* id - unique identifier for each invoices generated
	* Date_time
	* postal_address
	* payee - id of the user
	* cart_no - //details about the cart are yet to be discussed
	* transaction_id - id from transaction
	* amount
	* text - text to be imprinted in invoice
	//rest details are dependent on cart
