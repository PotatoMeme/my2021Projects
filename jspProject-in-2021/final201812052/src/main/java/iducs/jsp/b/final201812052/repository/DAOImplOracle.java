package iducs.jsp.b.final201812052.repository;

import java.sql.*;

public class DAOImplOracle implements DAO {
    private Connection conn = null;
    @Override
    public Connection getConnection() {
        String jdbcUrl = "jdbc:oracle:thin:@localhost:1521:XE";
        String dbUser = "system";
        String dbPass = "cometrue";
        try {
            Class.forName("oracle.jdbc.OracleDriver");//드라이버 로딩
            conn = DriverManager.getConnection(jdbcUrl, dbUser, dbPass);
            // 적재된 드라이버 관리자 객체의 getConnection() 정적메소드를 호출하며 Connection 객체 생성
            // Connection -> Statement / PreparedStatement 개체생성 -> query실행
            // -> ResultSet (read) or 영향 받은 row 수 (create, update, delete) 반환
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }
        return conn;
    }

    @Override
    public void closeResources(Connection conn, Statement stmt, PreparedStatement pstmt, ResultSet rs) {

    }
}
