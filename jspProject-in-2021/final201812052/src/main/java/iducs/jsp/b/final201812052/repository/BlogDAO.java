package iducs.jsp.b.final201812052.repository;

import iducs.jsp.b.final201812052.model.Blog;
import iducs.jsp.b.final201812052.util.Pagination;
import java.util.List;

// crud : create read update delete
// http method : post, get, put, delete
public interface BlogDAO {
    int create(Blog blog);
    Blog read(Blog blog);
    List<Blog> readList();
    int update(Blog blog);
    int delete(Blog blog);

    int readTotalRows();
    List<Blog> readListPagination(Pagination pagination);
    List<Blog> readListPaginationwithSort(int by,Pagination pagination);
}
