/* Jadon Silva, Mustafa Eldmerdash, Michael Komnick
       Apr 12, 2022
       Project Checkpoint 3
       Example Queries
*/

/*------------------------------------------------------------------------------------
  1) What is the average rating of location category for Aryes from Jan 1st 2019
     to Jan 1st 2020
  ------------------------------------------------------------------------------------*/

  select avg(rating) as average from reviews, reviewCat, dorms 
  where reviews.dormid = dorms.dormid
  AND reviews.rcid = reviewCat.rcid
  And catname like 'location'
  And dname like 'Aryes'
  And revdate BETWEEN '2019-01-01' And '2020-01-01';

/*------------------------------------------------------------------------------------
  2) What is the overall rating (average of the averages of each category) of Benedict
  ------------------------------------------------------------------------------------*/

  select avg(rating) as average from reviews, reviewCat, dorms 
  where reviews.dormid = dorms.dormid
  AND reviews.rcid = reviewCat.rcid
  And dname like 'Benedict';

/*------------------------------------------------------------------------------------
  3) List the dorms based on their rating for a category (location) in descending order
  ------------------------------------------------------------------------------------*/

select dname, avg(rating) as average from reviews, reviewCat, dorms
  where reviews.dormid = dorms.dormid
  and reviews.rcid = reviewCat.rcid
  and reviewCat.catname like 'location'
  group by dname
  order by average desc
;

/*------------------------------------------------------------------------------------
  4) What is the overall rating (average of the categories) that somebody "Angela" gave
     for a dorm (Aryes)
  ------------------------------------------------------------------------------------*/

  select avg(rating) as average from reviews, reviewCat, dorms, users 
  where reviews.dormid = dorms.dormid
  AND reviews.rcid = reviewCat.rcid
  And reviews.usrid = users.usrid
  And fname like 'Angela'
  And dname like 'Aryes';


/*------------------------------------------------------------------------------------
  5) List all of the dorms that have a rating of at least 4 out of 5 in
     at least 1 category
  ------------------------------------------------------------------------------------*/

select dname from (select dname, catname, avg(rating) as average
    from reviews, reviewCat, dorms
    where reviews.dormid = dorms.dormid
    and reviews.rcid = reviewCat.rcid
    group by dname, catname
    order by average desc) avgByDormCat
  where avgByDormCat.average >= 8
  order by dname asc
;

/*------------------------------------------------------------------------------------
  6) List all of the users that have rated more than one dorm
  ------------------------------------------------------------------------------------*/

  select fname, lname from users, reviews, dorms,
    (select count(*) as dormsRated, reviews.usrid as user from dorms, reviews, users
     where users.usrid = reviews.usrid
     AND dorms.dormid = reviews.dormid
     group by user) ratings
  where users.usrid = reviews.usrid
  And reviews.dormid = dorms.dormid
  AND ratings.dormsRated > 1
  AND ratings.user = users.usrid
  group by fname, lname
  order by fname asc;

/*------------------------------------------------------------------------------------
  7) List all of the reviews that "Angela" has made by highest review
     in descending order
  ------------------------------------------------------------------------------------*/

  select  dname, rating, comments from reviews, reviewCat, users, dorms
  where users.usrid = reviews.usrid
  AND reviews.rcid = reviewCat.rcid
  AND dorms.dormid = reviews.dormid
  AND users.fname like 'Angela'
  order by rating desc;
