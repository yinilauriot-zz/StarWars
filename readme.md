Antoine:

DATABASE: 
- DO NOT LAUNCH THE SEEDERS
- The database is exported in the file db_starswar.sql which you find at the root of projet. You just need launch install.sh

USER ACCOUNT:
- Administrator: yini@yini.fr(password: yini), Editor: anna@anna.fr(password: anna), Visitor: tony@tony.fr(password: tony)
- Add the registration in the table users and customers

EVOLUTIONS:
- Add the new field score in the table products, the 4 best sellers will be present at the bottom of the product detail page
- Increase each product score when the order is saved in the table histories
- Add the new field command_id in the table histories in order to identify the products commanded by command ID
- Quantity is optional in consideration of the stock in the product detail page (managed by Ajax)
- Quantity is changeable in consideration of the stock and the total price is relatively updated in the cart page (managed by Ajax)
- The user should be logined in, his address and card number should be available in the table customers in order to finalize the order
- Increase the field number_command in the table customers when the order is saved in the table histories
- Decrease the field quantity for each product in the table products when the order is saved in the table histories
- Inifite scroll with pagination loading on Home page (managed by Ajax)