/* Jadon Silva, Mustafa Eldmerdash, Michael Komnick
       Apr 30, 2022
       Latest database build file
*/

drop database if exists ratemydorms;
create database ratemydorms;
use ratemydorms;
grant select,insert,delete on ratemydorms.* to 'UsernameRedacted'@'%'  identified by 'PasswordRedacted';

#--------------------------------------------------------------------

create table dorms(
        dormid               int AUTO_INCREMENT NOT NULL PRIMARY KEY
       ,dname                varchar(32)
       ,dormdesc             varchar(1024)
);

create table users(
        usrid                int AUTO_INCREMENT NOT NULL PRIMARY KEY
       ,fname                varchar(32)
       ,lname                varchar(32)
       ,usrname              varchar(64)
       ,pass                 varchar(128)
       ,email                varchar(64)
       ,gradyr               int
);

create table reviewCat(
       rcid                  int AUTO_INCREMENT NOT NULL PRIMARY KEY
      ,catname               varchar(32) NOT NULL
      ,catdesc               varchar(1024) NOT NULL
);

create table reviews(
       revid                 int AUTO_INCREMENT NOT NULL
      ,usrid                 int NOT NULL
      ,dormid                int NOT NULL
      ,rcid                  int NOT NULL
      ,rating                int
      ,comments              varchar(1024)
      ,revdate               date
      ,PRIMARY KEY (revid, usrid, dormid)
);

create table questions(
       qid                   int AUTO_INCREMENT NOT NULL
      ,usrid                 int NOT NULL
      ,dormid                int NOT NULL
      ,quest                 varchar(256)
      ,qdate                 date
      ,PRIMARY KEY (qid, usrid, dormid)
);

create table answers(
       answid                int AUTO_INCREMENT NOT NULL
      ,usrid                 int NOT NULL
      ,qid                   int NOT NULL
      ,answ                  varchar(1024)
      ,adate                 date
      ,PRIMARY KEY (answid, usrid, qid)
);

#--------------------------------------------------------------------

insert into dorms(dname,dormdesc)
       values
           ("Aryes", "Ayres Hall opened in August 2016 as a coed residence hall that houses first-year students as well as upperclass students. Named in recognition of Robert Moss Ayres Jr. (C'49, and former vice-chancellor of the University), this hall stands on the former location of Van Ness Hall and is located on Alabama Avenue.")
          ,("Benedict", "Benedict Hall, a coed residence hall built in 1963, is one of three residence halls on campus whose rooms are arranged around a central, enclosed courtyard. The large, well-lit courtyard serves as a frequent site for student gatherings and activities.")
          ,("Cannon", "Built in 1926, Cannon Hall accommodates 51 students. Cannon Hall is located a short walk from the Quadrangle on South Carolina Avenue. When it was first built in the 1920s, Cannon was recognized for being one of the finest residence halls in the country, and its cozy common room is much loved by its residents.")
          ,("Cleveland", "Built in 1956, Cleveland Hall is another centrally located coed residence hall that houses 60 students. Cleveland Hall is located directly across from the newly constructed Wellness Commons.")
          ,("Courts", "Courts Hall, built in 1967, is a two-story coed residence hall located on the corner of Georgia Avenue and Hall Street, with rooms opening into fresh air hallways. It is one of three residence halls on campus whose rooms are arranged around a central, enclosed courtyard. It also offers great views of Lake Finney and is a short walk to Stirling's Coffee House.")
          ,("Elliott", "Initially built to be the Sewanee Inn, Elliott Hall now houses 55 men from all classes in the College. Built in 1922, Elliott Hall's beginnings as the Sewanee Inn can still be seen today. Located on University Avenue, Elliott is a short walk from the newly constructed Wellness Commons and McClurg Dining Hall.")
          ,("Gorgas", "Gorgas Hall is a coed residence hall located on Tennessee Avenue, within a short walk of Puett Field and the Tennessee Williams Performing Arts Center. Gorgas is located about halfway between central campus and the War Memorial Cross, one of Sewanee's most striking overlooks.")
          ,("Hodgson", "Originally the site of Emerald-Hodgson Hospital, Hodgson Hall (along with its companion residences, Phillips Hall and Emery Hall) has great historical significance for Sewanee residents. Hodgson Hall is a private coed residence hall reserved for upperclass students and is equidistant from the Fowler Sport and Fitness Center and central campus.")
          ,("Hoffman", "Built in 1921, Hoffman Hall is located close to the intersection of Mississippi Avenue and University Avenue and is adjacent to Manigault Park. It is next to St. Luke's Hall and is a coed residence hall about halfway between the Bishop's Common and the Fowler Sport and Fitness Center. Hoffman is one of our smallest residence halls, housing roughly 50 students.")
          ,("Humphreys", "Humphreys Hall, built in 2003, is named in honor of alumnus David Humphreys, C'79, and his wife, Debra, who provided a generous gift that made the residence hall a reality. The lodge-style building houses 118 students. Humphreys is coed and located on the corner of Georgia and Mississippi Avenues and is a three-minute walk from Stirling's Coffee House.")
          ,("Hunter", "Built in 1953, Hunter Hall is a two-story coed residence hall located across from Elliott Hall on University Avenue. Hunter Hall is equidistant from central campus and the Sewanee Village and houses close to 90 students.")
          ,("Johnson", "Built in 1926, Johnson Hall is one of the oldest residence halls on campus. Located on University Avenue directly across from Manigault Park and St. Luke's Hall, Johnson Hall is conveniently located in the heart of central campus. Standing three stories tall, Johnson Hall houses approximately 56 female students.")
          ,("McCrady", "McCrady Hall is located on Alabama Avenue, near McClurg Dining Hall, Snowden Hall, Gailor Hall, Woods Labs, and duPont Library. Originally built in 1964, this residence hall has a tower-like feature resembling a castle (and yes, you can live in the McCrady tower!).")
          ,("Phillips", "Originally home to the nurses who worked at Emerald-Hodgson Hospital, Phillips Hall is now offers singles and doubles to 26 upperclass women. ")
          ,("Quintard", "Quintard Memorial Hall was gifted to the University in 1900 by George W. Quintard in memory of his brother, the Rt. Rev. Charles Todd Quintard, the second bishop of Tennessee and first vice-chancellor of the University. In 1990, Quintard was renovated and reopened as a coed residence hall.")
          ,("Smith", "Smith Hall a coed residence hall houses 90 students. It opened in 2013 as a coed residence for mostly first-year students. Smith Hall was named in recognition of a 2012 gift to the University from Herbert E. Smith Sr., C’1903, his wife, Lucy, and their son, Herbert E. Smith Jr., C’36, and his wife, Elizabeth “Bibby” Smith. It is built with many local, repurposed, and renewable resources and is LEED Silver equivalent.")
          ,("St. Luke's", "Built in 1887, St. Luke's Hall overlooks Manigault Park and University Avenue, St. Luke's Hall is adjacent to St. Luke's Chapel, the Bishop's Common, and Hoffman Hall. St. Luke's hall is coed and houses approximately 115 students.")
          ,("Trezevant", "Trezevant Hall is an all male residence hall located between two beautiful lakes and is approximately an eight-minute walk from central campus. Built in the late 1960s, Trezevant is a two-story building in a U shape, so all rooms open to a central courtyard.")
          ,("Tuckaway", "Built in 1929, Tuckaway Hall marked Sewanee's first use of fieldstone architecture in its buildings. Tuckaway is a co-ed residence hall and is located on Tennessee Avenue, just a short walk from the newly constructed Wellness Commons.")
;
