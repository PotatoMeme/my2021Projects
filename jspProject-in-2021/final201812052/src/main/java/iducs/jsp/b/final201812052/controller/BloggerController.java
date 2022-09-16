package iducs.jsp.b.final201812052.controller;

import iducs.jsp.b.final201812052.model.Blog;
import iducs.jsp.b.final201812052.model.Blogger;
import iducs.jsp.b.final201812052.repository.BloggerDAOImpl;
import iducs.jsp.b.final201812052.util.DescByBlogTitle;
import iducs.jsp.b.final201812052.util.Pagination;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import java.io.IOException;
import java.util.ArrayList;

// Controller
// 첫 슬래시는 웹 애플리케이션의 시작위치임
//
@WebServlet(name = "bloggers", urlPatterns = { "/blogger/login.do","/blogger/register.do","/blogger/register-admin.do"
        ,"/bloggers/login-form.do","/bloggers/register-form.do","/bloggers/register-admin-form.do","/bloggers/login.do","/bloggers/logout.do"
        ,"/bloggers/register.do","/bloggers/detail.do","/bloggers/update.do","/bloggers/update-form.do","/bloggers/delete.do","/bloggers/list.do"})
public class BloggerController extends HttpServlet {


    BloggerDAOImpl dao = new BloggerDAOImpl();
    public void doService(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        HttpSession session = request.getSession();
        request.setCharacterEncoding("UTF-8"); //포스트에서는 꼭 지정해줘야함 자동으로 ms949?가 기본으로 되기 때문
        String uri = request.getRequestURI();//uri 전채
        String contextPath = request.getContextPath();// /Gradle~war
        String command = uri.substring(contextPath.length() + 1); // blogs/post.do,  blogs/get.do가 반환됨
        String action = command.substring(command.lastIndexOf("/") + 1);

        System.out.println("command : " + action);

        Blogger blogger = new Blogger();

        if (action.equals("register.do")) {//test scripting elements


            blogger.setEmail(request.getParameter("email"));
            blogger.setPw(request.getParameter("pw"));
            blogger.setName(request.getParameter("name"));
            blogger.setPhone(request.getParameter("phone"));
            blogger.setAddress(request.getParameter("address"));


            if (dao.create(blogger) > 0) {
                request.setAttribute("blogger", blogger);
                request.setAttribute("msg", "성공 : 회원 등록을 성공하였습니다.");
                // 처리 결과를 view에 전달한다.
                request.getRequestDispatcher("../status/message.jsp").forward(request, response);
            } else {
                request.setAttribute("msg", "실패 : 회원 등록을 실패하였습니다.");
                request.getRequestDispatcher("../status/message.jsp").forward(request, response);
            }
        }
        else if (action.equals("register-admin.do")) {//test scripting elements


            blogger.setEmail(request.getParameter("email"));
            blogger.setPw(request.getParameter("pw"));
            blogger.setName(request.getParameter("name"));
            blogger.setPhone(request.getParameter("phone"));
            blogger.setAddress(request.getParameter("address"));



            if (dao.createAdmin(blogger) > 0) {
                request.setAttribute("blogger", blogger);
                request.setAttribute("msg", "성공 : 회원 등록을 성공하였습니다.");
                // 처리 결과를 view에 전달한다.
                request.getRequestDispatcher("../status/message.jsp").forward(request, response);
            } else {
                request.setAttribute("msg", "실패 : 회원 등록을 실패하였습니다.");
                request.getRequestDispatcher("../status/message.jsp").forward(request, response);
            }
        }
        else if (action.equals("login.do")) {


            blogger.setEmail(request.getParameter("email"));
            blogger.setPw(request.getParameter("pw"));
            Blogger retBlogger = null;

            if ((retBlogger = dao.read(blogger)) != null) {

                request.setAttribute("blogger", retBlogger);
                session.setAttribute("blogger",blogger.getEmail());

                session.setAttribute("logined", retBlogger); // session 처리
                request.getRequestDispatcher("../main/index.jsp").forward(request, response);
            } else {
                request.setAttribute("msg", "실패 : 회원 로그인 실패하였습니다.");
                request.getRequestDispatcher("../status/message.jsp").forward(request, response);
            }

        }else if (action.equals("logout.do")) {
           session.invalidate();
            request.getRequestDispatcher("../main/index.jsp").forward(request, response);
        }else if (action.equals("login-form.do")) {
               request.getRequestDispatcher("../bloggers/login.jsp").forward(request, response);
        }else if (action.equals("register-form.do")) {
            request.getRequestDispatcher("../bloggers/register.jsp").forward(request, response);


        }else if (action.equals("register-admin-form.do")) {
            request.getRequestDispatcher("../bloggers/register-admin.jsp").forward(request, response);


        }else if (action.equals(("detail.do"))) {
            blogger.setId(Long.parseLong(request.getParameter("id")));
            Blogger retBlogger = null;
            if ((retBlogger = dao.readById(blogger)) != null) {

                request.setAttribute("blogger", retBlogger);
                request.getRequestDispatcher("../bloggers/detail-form.jsp").forward(request, response);
            } else {
                request.getRequestDispatcher("../blogs/error.jsp").forward(request, response);
                System.out.println("errors");
            }
        }else if (action.equals("update-form.do")) {//test scripting elements
            blogger.setId(Long.parseLong(request.getParameter("id")));
            Blogger retBlogger = null;
            if ((retBlogger = dao.readById(blogger)) != null) {

                request.setAttribute("blogger", retBlogger);

                request.getRequestDispatcher("../bloggers/update-form.jsp").forward(request, response);
            } else {
                request.getRequestDispatcher("../blogs/error.jsp").forward(request, response);
                System.out.println("errors");
            }
        } else if (action.equals("update.do")) {//test scripting elements
            blogger.setId(Long.parseLong(request.getParameter("id")));
            blogger.setEmail(request.getParameter("email"));
            blogger.setPw(request.getParameter("pw"));
            blogger.setName(request.getParameter("name"));
            blogger.setPhone(request.getParameter("phone"));
            blogger.setAddress(request.getParameter("address"));
            blogger.setRank(Long.parseLong(request.getParameter("rank")));



            if (dao.update(blogger) > 0) {
                if(Long.parseLong(request.getParameter("sessionid")) == Long.parseLong(request.getParameter("id"))){

                    System.out.println("true");
                    //session.setAttribute("blogger",blogger.getEmail());
                    session.setAttribute("logined",blogger);
                }
                request.setAttribute("blogger", blogger);

                request.getRequestDispatcher("../main/index.jsp").forward(request, response);
            } else {
                request.getRequestDispatcher("../blogs/error.jsp").forward(request, response);
                System.out.println("error");
            }
        }else if (action.equals(("delete.do"))) {
            blogger.setId(Long.parseLong(request.getParameter("id")));
            long sessionid = Long.parseLong(request.getParameter("sessionid"));
            System.out.print(blogger.getId());
            System.out.print(sessionid);
            //long id =Long.parseLong(request.getParameter("id"));
            //blog.setId(id);

            if (dao.delete(blogger) > 0) {// update를 위한 정보 조회후 view에 전당

                if(sessionid == blogger.getId()){
                    session.invalidate();
                }
                request.setAttribute("blogger", blogger);
                request.setAttribute("work", "삭제");
                //처리결과를 view에 전달 about -> processok
                request.getRequestDispatcher("../blogs/about.jsp").forward(request, response);
            } else {
                request.getRequestDispatcher("./blogs/error.jsp").forward(request, response);
                System.out.println("error");
            }
        }else if (action.equals("list.do")) {
            ArrayList<Blogger> bloggerList = new ArrayList<Blogger>(); // 처리결과 한개 이상의 블로그를 저장하는 객체
            String properties = request.getParameter("by");
            String text []= properties.split("-");
            properties = text[0];
            String pageNo = text[1]; // 매개변수로 전달된 현재 페이지 번호가 정수현으로 저장int curPageNo = (pageNo != null)? Integer.parseInt(pageNo):1;
            int curPageNo = (pageNo != null)? Integer.parseInt(pageNo):1;
            int perPage = 3; // 한 페이지에 나타나는 행의 수
            int perPagination = 3; // 한 화면에 나타나는 페이지 번호 수
            int totalRows = dao.readTotalRows(); // dao에서 총 행의 수를 질의함

            Pagination pagination = new Pagination(curPageNo, perPage, perPagination, totalRows);
            if((bloggerList = (ArrayList<Blogger>) dao.readListPaginationwithSort(Integer.parseInt(properties),pagination)) != null) { // 한 개 이상의 블로그가 반환. JCF(Java Collection Framework)에 대한 이해
                request.setAttribute("bloggerList", bloggerList);
                request.setAttribute("properties", properties);
                request.setAttribute("pagination", pagination);
                request.getRequestDispatcher("list.jsp").forward(request, response); // blogs/list.jsp로 포워딩
            } else {
                request.setAttribute("msg", "실패 : 블로그 목록 조회 실패");
                request.getRequestDispatcher("error.jsp").forward(request, response);; // 오류
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