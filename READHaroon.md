1. I created a controller named CustomerController and a view called customer where I implemented all the functionalities.

2. I set up 4 models with their migrations and factories: Customer, Items, Order, and OrderedItems. The relationships are:

A customer can have many orders.
An order can have many ordered items.

3. I used database seeding to generate data for testing purposes.

4. At this stage, I didn’t focus much on the design. Instead, I created a simple view to display all customers with pagination and added a search option. The search can be done by customer email, item name, or order number.

5. For optimization, I implemented the search functionality like this:

I first get the search term from the request.
I used Customer::with('orders.orderedItems') to load related data in a single query. This reduces the number of queries and improves performance.
I used the when method to add search filters only if a search term is provided.
The search can filter results by:

Customer email
Order number
Item name

6. I also used paginate(10) to show 10 results per page, which helps with memory usage and speeds up loading times for large datasets.