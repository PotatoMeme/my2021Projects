package iducs.jsp.b.final201812052.repository;

import iducs.jsp.b.final201812052.model.Blog;
import iducs.jsp.b.final201812052.model.Blogger;
import iducs.jsp.b.final201812052.util.Pagination;

import java.util.List;

// crud : create read update delete
// http method : post, get, put, delete
public interface BloggerDAO {


    int create(Blogger blogger);
    int createAdmin(Blogger blogger);
    Blogger read(Blogger blogger);
    List<Blogger> readList();
    int update(Blogger blogger);
    int delete(Blogger blogger);
    int readTotalRows();
    List<Blogger> readListPagination(Pagination pagination);
    List<Blogger> readListPaginationwithSort(int by,Pagination pagination);
}
