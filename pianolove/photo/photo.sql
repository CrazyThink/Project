create table photo (
   num int not null auto_increment,
   id char(15) not null,
   nick  char(10) not null,
   subject char(100) not null,
   regist_day char(20),
   file_name_0 char(40),
   file_copied_0 char(30),
   primary key(num)
);