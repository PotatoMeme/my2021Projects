package iducs.jsp.b.final201812052.repository;

import iducs.jsp.b.final201812052.model.Blog;
import iducs.jsp.b.final201812052.model.Blogger;
import iducs.jsp.b.final201812052.util.Pagination;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class BloggerDAOImpl extends DAOImplOracle implements BloggerDAO {
    Connection conn = null;
    Statement stmt = null;
    PreparedStatement pstmt = null;
    ResultSet rs = null;

    // new BlogDAOImpl()로 생성한 객체는 연결 객체를 가지게 됨
    public BloggerDAOImpl() { // 생성자
        this.conn = getConnection(); // DAOImplOracle의 getConnection()을 호출하여 반환
    }


    @Override
    public int create(Blogger blogger) {
        String sql = "insert into blogger201812052 values(seq_blogger201812052.nextVal, ?, ?, ?, ?,?,0)";
        int rows = 0;
        try {
            pstmt = conn.prepareStatement(sql);
            pstmt.setString(1, blogger.getEmail());
            pstmt.setString(2, blogger.getPw());
            pstmt.setString(3, blogger.getName());
            pstmt.setString(4, blogger.getPhone());
            pstmt.setString(5, blogger.getAddress());

            rows = pstmt.executeUpdate();// 1이상이면 정상, 0이하면 오류
        } catch (SQLException throwables) {
            throwables.printStackTrace();
            System.out.println(rows);
        }
        System.out.println(rows);
        return rows;
    }
    @Override
    public int createAdmin(Blogger blogger) {
        String sql = "insert into blogger201812052 values(seq_blogger201812052.nextVal, ?, ?, ?, ?,?,1)";
        int rows = 0;
        try {
            pstmt = conn.prepareStatement(sql);
            pstmt.setString(1, blogger.getEmail());
            pstmt.setString(2, blogger.getPw());
            pstmt.setString(3, blogger.getName());
            pstmt.setString(4, blogger.getPhone());
            pstmt.setString(5, blogger.getAddress());

            rows = pstmt.executeUpdate();// 1이상이면 정상, 0이하면 오류
        } catch (SQLException throwables) {
            throwables.printStackTrace();
            System.out.println(rows);
        }
        System.out.println(rows);
        return rows;
    }

    @Override
    public Blogger read(Blogger blogger) {
        Blogger retBlogger = null;
        String sql = "select * from blogger201812052 where email=? and pw=?";
        // 유일키(unique key)로 조회 유일키에 맞는 id 로 설정
        try {
            pstmt = conn.prepareStatement(sql);
            System.out.println("email"+blogger.getEmail());
            System.out.println("pw"+blogger.getPw());
            pstmt.setString(1, blogger.getEmail());
            pstmt.setString(2, blogger.getPw());

            rs = pstmt.executeQuery();
            if(rs.next()) { // rs.next()는 반환된 객체에 속한 요소가 있는지를 반환하고, 다름 요소로 접근

                retBlogger = new Blogger();
                retBlogger.setId(rs.getLong("id"));
                retBlogger.setEmail(rs.getString("email"));
                retBlogger.setPw(rs.getString("pw"));
                retBlogger.setName(rs.getString("name"));
                retBlogger.setPhone(rs.getString("phone"));
                retBlogger.setAddress(rs.getString("address"));
                retBlogger.setRank(rs.getLong("rank"));
            }
        } catch (SQLException throwables) {
            System.out.println();
            throwables.printStackTrace();
        }
        return retBlogger;
    }
    @Override
    public int readTotalRows() {
        int rows = 0;
        String sql = "select count(*) as totalRows from blogger201812052";
        try {
            stmt = conn.createStatement();
            // execute(sql)는 모든 질의에 사용가능, executeQuery(sql)는 select에만, executeUpdate()는 insert, update, delete에 사용 가능
            rs = stmt.executeQuery(sql);
            if (rs.next()) {
                rows = rs.getInt("totalRows");
            }
        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }
        return rows;
    }
    @Override
    public List<Blogger> readListPagination(Pagination pagination) {
        ArrayList<Blogger> bloggerList  = null;
        String sql = "select * from (" +
                "select A.*, rownum as rnum from (" +
                "select * from blogger201812052 order by id desc) A) where rnum >= ? and rnum <= ?";
        try {
            pstmt = conn.prepareStatement(sql);
            pstmt.setInt(1, pagination.getFirstRow());
            pstmt.setInt(2, pagination.getEndRow());
            rs = pstmt.executeQuery();
            // execute(sql)는 모든 질의에 사용가능, executeQuery(sql)는 select에만, executeUpdate()는 insert, update, delete에 사용 가능
            bloggerList = new ArrayList<Blogger>();
            while (rs.next()) {
                Blogger blogger = new Blogger();
                blogger.setId(rs.getLong("id"));
                blogger.setEmail(rs.getString("email"));
                blogger.setPw(rs.getString("pw"));
                blogger.setName(rs.getString("name"));
                blogger.setPhone(rs.getString("phone"));
                blogger.setAddress(rs.getString("address"));
                blogger.setRank(rs.getLong("rank"));
                bloggerList.add(blogger);
            }
        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }
        return bloggerList;
    }
    //@Override
    public Blogger readById(Blogger blogger) {
        Blogger retBlogger = null;
        String sql = "select * from blogger201812052 where id=? ";
        // 유일키(unique key)로 조회 유일키에 맞는 id 로 설정
        try {
            pstmt = conn.prepareStatement(sql);
            pstmt.setLong(1, blogger.getId());
            rs = pstmt.executeQuery();
            if(rs.next()) { // rs.next()는 반환된 객체에 속한 요소가 있는지를 반환하고, 다름 요소로 접근
                retBlogger = new Blogger();
                retBlogger.setId(rs.getLong("id"));
                retBlogger.setEmail(rs.getString("email"));
                retBlogger.setPw(rs.getString("pw"));
                retBlogger.setName(rs.getString("name"));
                retBlogger.setPhone(rs.getString("phone"));
                retBlogger.setAddress(rs.getString("address"));
            }
        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }
        return retBlogger;
    }
    @Override
    public List<Blogger> readList() {
        ArrayList<Blogger> bloggerList  = null;
        String sql = "select * from blogger201812052 where rank !=1";
        try {
            stmt = conn.createStatement();
            // execute(sql)는 모든 질의에 사용가능, executeQuery(sql)는 select에만, executeUpdate()는 insert, update, delete에 사용 가능
            if((rs = stmt.executeQuery(sql)) != null) { // 질의 결과가 ResultSet 형태로 반환
                bloggerList = new ArrayList<Blogger>();
                while (rs.next()) {
                    Blogger blogger = new Blogger();
                    blogger.setId(rs.getLong("id"));
                    //id 갑도 dto에 저장
                    blogger.setName(rs.getString("name"));
                    blogger.setPw(rs.getString("pw"));
                    blogger.setEmail(rs.getString("email"));
                    blogger.setPhone(rs.getString("title"));
                    blogger.setAddress(rs.getString("address"));
                    bloggerList.add(blogger);
                }
            }
        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }
        return bloggerList;
    }

    public List<Blogger> readList(String sort) {
        ArrayList<Blogger> bloggerList  = null;
        String sql = "select * from blogger201812052 where rank !=1 ";
        if(sort == "1"){
            sql = "select * from blogger201812052 where rank !=1order by id asc ";
        }else if(sort == "2"){
            sql = "select * from blogger201812052 where rank !=1 order by name asc";
        }else if(sort == "3"){
            sql = "select * from blogger201812052 where rank !=1 order by email asc";
        }else if(sort == "4"){
            sql = "select * from blogger201812052 where rank !=1 order by id desc ";
        }else if(sort == "5"){
            sql = "select * from blogger201812052 where rank !=1 order by name desc";
        }else if(sort == "6"){
            sql = "select * from blogger201812052 where rank !=1 order by email desc";
        }

        try {
            stmt = conn.createStatement();
            // execute(sql)는 모든 질의에 사용가능, executeQuery(sql)는 select에만, executeUpdate()는 insert, update, delete에 사용 가능
            if((rs = stmt.executeQuery(sql)) != null) { // 질의 결과가 ResultSet 형태로 반환
                bloggerList = new ArrayList<Blogger>();
                while (rs.next()) {
                    Blogger blogger = new Blogger();
                    blogger.setId(rs.getLong("id"));
                    //id 갑도 dto에 저장
                    blogger.setName(rs.getString("name"));
                    blogger.setPw(rs.getString("pw"));
                    blogger.setEmail(rs.getString("email"));
                    blogger.setPhone(rs.getString("title"));
                    blogger.setAddress(rs.getString("address"));
                    bloggerList.add(blogger);
                }
            }
        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }
        return bloggerList;
    }
    public List<Blogger> readListByPage(int start) {
        ArrayList<Blogger> bloggerList  = null;
        String sql = "SELECT * FROM ( SELECT ROW_NUMBER() OVER (ORDER BY id) NUM , A.* FROM (select * from blogger201812052 where not rank = 1) A  where rank !=1  ORDER BY id )  WHERE NUM BETWEEN ? AND ?;";
        try {
            pstmt = conn.prepareStatement(sql);
            pstmt.setInt(1, start);
            pstmt.setInt(2, (start+5));
            rs = stmt.executeQuery(sql);
            bloggerList = new ArrayList<Blogger>();
            while (rs.next()) {
                Blogger blogger = new Blogger();
                blogger.setId(rs.getLong("id"));
                //id 갑도 dto에 저장
                blogger.setName(rs.getString("name"));
                blogger.setPw(rs.getString("pw"));
                blogger.setEmail(rs.getString("email"));
                blogger.setPhone(rs.getString("title"));
                blogger.setAddress(rs.getString("address"));
                bloggerList.add(blogger);
            }
        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }
        return bloggerList;
    }
    @Override
    public List<Blogger> readListPaginationwithSort(int by, Pagination pagination) {
        ArrayList<Blogger> bloggerList  = null;
        String sql = "select * from ( SELECT ROW_NUMBER() OVER (ORDER BY id) NUM , A.* FROM (select * from blogger201812052 ) A  ORDER BY id)  WHERE NUM BETWEEN ? AND ?";
        if (by == 1){
            sql = "select * from ( SELECT ROW_NUMBER() OVER (ORDER BY id) NUM , A.* FROM (select * from blogger201812052 ) A  ORDER BY id)  WHERE NUM BETWEEN ? AND ?";
        }else if(by == 2){
            sql = "select * from ( SELECT ROW_NUMBER() OVER (ORDER BY email) NUM , A.* FROM (select * from blogger201812052 ) A  ORDER BY email)  WHERE NUM BETWEEN ? AND ?";
        }else if(by == 3){
            sql = "select * from ( SELECT ROW_NUMBER() OVER (ORDER BY name) NUM , A.* FROM (select * from blogger201812052 ) A  ORDER BY email)  WHERE NUM BETWEEN ? AND ?";
        }

        //where rnum >= ? and rnum <= ?
        try {
            pstmt = conn.prepareStatement(sql);

            pstmt.setInt(1, pagination.getFirstRow());
            pstmt.setInt(2, pagination.getEndRow());
            rs = pstmt.executeQuery();
            // execute(sql)는 모든 질의에 사용가능, executeQuery(sql)는 select에만, executeUpdate()는 insert, update, delete에 사용 가능
            bloggerList = new ArrayList<Blogger>();
            while (rs.next()) {
                Blogger blogger = new Blogger();
                blogger.setId(rs.getLong("id"));
                //id 갑도 dto에 저장
                blogger.setName(rs.getString("name"));
                blogger.setPw(rs.getString("pw"));
                blogger.setEmail(rs.getString("email"));
                blogger.setPhone(rs.getString("phone"));
                blogger.setAddress(rs.getString("address"));
                bloggerList.add(blogger);
            }
        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }
        return bloggerList;
    }

    @Override
    public int update(Blogger blogger) {
        String sql = "update blogger201812052 set email =?,  pw=?,name=?, phone=?, address=? where id=?";
        int rows = 0;
        try {
            pstmt = conn.prepareStatement(sql);
            pstmt.setString(1, blogger.getEmail());
            pstmt.setString(2, blogger.getPw());
            pstmt.setString(3, blogger.getName());
            pstmt.setString(4, blogger.getPhone());
            pstmt.setString(5, blogger.getAddress());
            pstmt.setLong(6, blogger.getId());

            rows = pstmt.executeUpdate();// 1이상이면 정상, 0이하면 오류
        } catch (SQLException throwables) {
            throwables.printStackTrace();
            System.out.println(blogger.getName());
        }
        System.out.println(rows);
        return rows;
    }

    @Override
    public int delete(Blogger blogger) {
        String sql = "delete from blogger201812052 where id=?";
        int rows = 0;
        try {
            pstmt = conn.prepareStatement(sql);
            pstmt.setLong(1, blogger.getId());

            rows = pstmt.executeUpdate();// 1이상이면 정상, 0이하면 오류
        } catch (SQLException throwables) {
            throwables.printStackTrace();
            System.out.println(rows);
        }
        System.out.println(rows);
        return rows;
    }
}
