# menustat-food-db :pizza:

:question: The Problem:
Many food-related studies require information on macronutrients present in food. While the USDA provides a relatively comprehensive database, it does not provide information for most foods sold in restaurants. By using menustat, one can obtain this information. However, the formatting in menustat is not very easy to work with, and furthermore images for foods are not provided. 

:bulb: The solution:
Here is a full rip of menustat in the USDA format that includes images for each food. Note that images are those that appear first in a Google search for the food; as such no checks were made for licensing.

Full rip of NYC's menustat food database, including images for each food. 
Also includes a PHP sample of how queries can be made. 

This DB includes all foods recorded (no duplicates) from menustat.

Find original source here: www.menustat.org/

***NOTE:
It appears that the menustat website is down (or at least for me it is). As such, I could only get 2008, 2010, 2013 - 2018. I believe I am only missing 2012. 

In USDA format.

A description of the table:

```
desc menustat;


Field,Type,Null,Key,Default,Extra
restaurant,varchar(100),YES,,NULL,
food_category,varchar(100),YES,,NULL,
description,varchar(500),YES,,NULL,
item_description,varchar(5000),YES,,NULL,
serving_size,double,YES,,NULL,
serving_size_text,varchar(100),YES,,NULL,
serving_size_unit,varchar(50),YES,,NULL,
serving_size_household,varchar(255),YES,,NULL,
nutrient_amount,double,NO,,NULL,
nutrient_name,varchar(100),YES,,NULL,
update_year,smallint,YES,,NULL,
data_source,varchar(100),YES,,NULL,
nutrient_unit,varchar(50),YES,,NULL,
```

For use in studies, non-commercial.
