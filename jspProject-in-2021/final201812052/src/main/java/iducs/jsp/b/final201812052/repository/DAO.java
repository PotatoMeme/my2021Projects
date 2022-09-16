package iducs.jsp.b.final201812052.repository;

import java.sql.Connection;
import java.sql.Statement;
import java.sql.PreparedStatement;
import java.sql.ResultSet;

// Data Access Obejct,DAO : 연결 및 자원 관리 메소드 정의
// 데이터 소스 (데이터의 출처,DBMS,XML,JSON,CSV,txt 파일)를  접근하여 처리하는 객체
public interface DAO {
    Connection getConnection();// 연결 객체를 가져오는 메서드 선언
    //자원을 회수하는 메소드 선언
    void closeResources(Connection conn, Statement stmt, PreparedStatement pstmt, ResultSet rs);
}
