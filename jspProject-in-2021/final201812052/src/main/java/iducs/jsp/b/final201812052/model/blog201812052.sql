create sequence seq_blog201812052 increment by 1 start with 1;
/*생성*/
create table blog201812052
(
    id      number(11)   not null primary key,
    name    varchar2(30) not null,
    email   varchar2(30) not null,
    title   varchar2(50),
    content varchar2(100)
);
/*삭제*/
drop sequence  seq_blog201812052;
drop table blog201812052;

update blog201812052 set name='이름', email ='comso@induk.ac.kr', title='제목', content='내용' where id='2' ;
/*update table set name=?, email =?, title=?, content=? where id=? ;*/


insert into blog201812052 values(seq_blog201812052.nextval, 'ksh', 'email@induk.ac.kr', '제목', '내용');
select * from blog201812052;