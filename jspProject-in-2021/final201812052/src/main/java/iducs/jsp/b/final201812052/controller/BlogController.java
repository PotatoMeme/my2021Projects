package iducs.jsp.b.final201812052.controller;

import iducs.jsp.b.final201812052.model.Blog;
import iducs.jsp.b.final201812052.repository.BlogDAOImpl;
import iducs.jsp.b.final201812052.util.DescByBlogTitle;
import iducs.jsp.b.final201812052.util.Pagination;

import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.annotation.*;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Collections;
// Controller
// 첫 슬래시는 웹 애플리케이션의 시작위치임
//
@WebServlet(name = "post", urlPatterns = {"/blogs/post-form.do", "/blogs/post.do",
        "/blogs/list.do", "/blogs/sort.do", "/main/index.do",
        "/blogs/detail.do", "/blogs/update-form.do", "/blogs/update.do", "/blogs/delete.do"}) // urlPatterns : 다수의 url을 기술할 수 있다.
public class BlogController extends HttpServlet {


    BlogDAOImpl dao = new BlogDAOImpl();
    protected void doService(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        request.setCharacterEncoding("UTF-8");
        String uri = request.getRequestURI();
        String contextPath = request.getContextPath();
        String command = uri.substring(contextPath.length() + 1); // blogs/post.do,  blogs/list.do가 반환됨
        String action = command.substring(command.lastIndexOf("/") + 1); // post.do, list.do 반환

        if(action.equals("post.do")) {
            Blog blog = new Blog();
            blog.setName(request.getParameter("name"));
            blog.setEmail(request.getParameter("email"));
            blog.setTitle(request.getParameter("title"));
            blog.setContent(request.getParameter("content"));
            System.out.println(blog.getName());
            System.out.println(blog.getEmail());
            System.out.println(blog.getTitle());
            System.out.println(blog.getContent());

            if (dao.create(blog) > 0) {
                request.setAttribute("blog", blog);
                // 처리 결과를 view에 전달한다.
                request.getRequestDispatcher("about.jsp").forward(request, response);
            } else {
                request.getRequestDispatcher("error.jsp").forward(request, response);
            }
        } else if(action.equals("list.do")) {
            ArrayList<Blog> blogList = new ArrayList<Blog>(); // 처리결과 한개 이상의 블로그를 저장하는 객체
            String pageNo = request.getParameter("pn"); // 매개변수로 전달된 현재 페이지 번호가 정수현으로 저장
            int curPageNo = (pageNo != null)? Integer.parseInt(pageNo):1;
            int perPage = 3; // 한 페이지에 나타나는 행의 수
            int perPagination = 3; // 한 화면에 나타나는 페이지 번호 수

            int totalRows = dao.readTotalRows(); // dao에서 총 행의 수를 질의함

            Pagination pagination = new Pagination(curPageNo, perPage, perPagination, totalRows);
            if((blogList = (ArrayList<Blog>) dao.readListPagination(pagination)) != null) { // 한 개 이상의 블로그가 반환. JCF(Java Collection Framework)에 대한 이해
                request.setAttribute("blogList", blogList);
                request.setAttribute("pagination", pagination);
                request.getRequestDispatcher("list.jsp").forward(request, response); // blogs/list.jsp로 포워딩
            } else {
                request.setAttribute("msg", "실패 : 블로그 목록 조회 실패");
                request.getRequestDispatcher("error.jsp").forward(request, response);; // 오류
            }
        }
        else if(action.equals("sort.do")) {
            ArrayList<Blog> blogList = new ArrayList<Blog>(); // 처리결과 한개 이상의 블로그를 저장하는 객체
            String properties = request.getParameter("by");
            String text []= properties.split("-");
            properties = text[0];
            String pageNo = text[1]; // 매개변수로 전달된 현재 페이지 번호가 정수현으로 저장
            System.out.println(properties +"" +pageNo);
            System.out.println(pageNo);
            int curPageNo = (pageNo != null)? Integer.parseInt(pageNo):1;
            int perPage = 3; // 한 페이지에 나타나는 행의 수
            int perPagination = 3; // 한 화면에 나타나는 페이지 번호 수

            int totalRows = dao.readTotalRows(); // dao에서 총 행의 수를 질의함

            Pagination pagination = new Pagination(curPageNo, perPage, perPagination, totalRows);
            if((blogList = (ArrayList<Blog>) dao.readListPaginationwithSort(Integer.parseInt(properties),pagination)) != null) { // 한 개 이상의 블로그가 반환. JCF(Java Collection Framework)에 대한 이해
                request.setAttribute("blogList", blogList);
                request.setAttribute("properties", properties);
                request.setAttribute("pagination", pagination);
                request.getRequestDispatcher("sort.jsp").forward(request, response); // blogs/list.jsp로 포워딩
            } else {
                request.setAttribute("msg", "실패 : 블로그 목록 조회 실패");
                request.getRequestDispatcher("error.jsp").forward(request, response);; // 오류
            }
        }
        else if (action.equals("detail.do")) {
            // ?email=이메일 : queryString으로 요청한 경우, email 파라미터에 이메일이라는 문자열 값을 전달
            // System.out.println(request.getParameter("email")); // 요청에 포함된 파라미터 중 email 파라미터 값을 접근
            Blog blog = new Blog();
            String strId = request.getParameter("id");
            long id = Long.parseLong(strId);
            blog.setId(id);
            Blog retBlog = null;
            if((retBlog = dao.read(blog)) != null) {
                request.setAttribute("blog", retBlog); // key -> blog
                request.getRequestDispatcher("detail.jsp").forward(request, response);
            } else {
                request.setAttribute("errMsg", "블로그 조회 실패");
                request.getRequestDispatcher("error.jsp").forward(request, response);; // 오류
            }
        } else if(action.equals("update-form.do")) { // update를 위한 정보 조회후 view에게 전달송
            Blog blog = new Blog();
            String strId = request.getParameter("id");
            long id = Long.parseLong(strId);
            blog.setId(id);
            Blog retBlog = null;
            if((retBlog = dao.read(blog)) != null) {
                request.setAttribute("blog", retBlog); // key -> blog
                request.getRequestDispatcher("updateForm.jsp").forward(request, response);
            } else {
                request.setAttribute("errMsg", "블로그 업데이트를 위한 조회 실패");
                request.getRequestDispatcher("error.jsp").forward(request, response);; // 오류
            }
        } else if(action.equals("update.do")) { // dao에게 업데이트를 요청
            Blog blog = new Blog();
            blog.setId(Long.parseLong(request.getParameter("id")));
            blog.setName(request.getParameter("name"));
            blog.setEmail(request.getParameter("email"));
            blog.setTitle(request.getParameter("title"));
            blog.setContent(request.getParameter("content"));

            if(dao.update(blog) > 0) {
                request.setAttribute("blog", blog);
                // 처리 결과를 view에 전달한다. about.jsp -> processok.jsp
                request.getRequestDispatcher("about.jsp").forward(request, response);
            } else {
                request.getRequestDispatcher("error.jsp").forward(request, response);
            }
        }
        else if(action.equals("delete.do")) { // dao에게 업데이트를 요청
            Blog blog = new Blog();
            blog.setId(Long.parseLong(request.getParameter("id")));

            if(dao.delete(blog) > 0) {
                request.setAttribute("blog", blog);
                request.setAttribute("work", "블로그 삭제");
                // 처리 결과를 view에 전달한다. about.jsp -> processok.jsp
                request.getRequestDispatcher("about.jsp").forward(request, response);
            } else {
                request.getRequestDispatcher("error.jsp").forward(request, response);
            }
        }

    }
    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
       doService(request, response);
    }

    public void doPost(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        doService(request, response);
    }

    public void destroy() {
    }
}