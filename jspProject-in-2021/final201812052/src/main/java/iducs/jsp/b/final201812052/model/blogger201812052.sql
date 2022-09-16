create sequence seq_blogger201812052 increment by 1 start with 1;
/*생성*/
create table blogger201812052
(
    id      number(11)   not null primary key,
    email   varchar2(30) not null unique ,
    pw     varchar2(20) not null,
    name    varchar2(30) not null,
    phone  varchar2(50),
    address varchar2(100),
    rank    number(11)
);
/*삭제*/
drop sequence  seq_blogger201812052;
drop table blogger201812052;

/*update blogger201812052 set name='이름', email ='comso@induk.ac.kr', title='제목', content='내용' where id='2' ;*/
/*update table set name=?, email =?, title=?, content=? where id=? ;*/


insert into blogger201812052 values(seq_blogger201812052.nextval,  'email@induk.ac.kr','cometrue','ksh', '201812052', '05121',0);
select * from blogger201812052;