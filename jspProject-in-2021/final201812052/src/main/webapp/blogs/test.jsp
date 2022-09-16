<%--
  Created by IntelliJ IDEA.
  User: user
  Date: 2021-11-18
  Time: 오후 3:27
  To change this template use File | Settings | File Templates.
--%>
<%@ page contentType="text/html;charset=UTF-8" pageEncoding="UTF-8" language="java" %>
<%@ page import="iducs.jsp.b.final201812052.model.*" %>
<%@ page import="java.util.ArrayList" %>

<html>
<head>
    <title>blogs/test.jsp</title>
</head>
<body>
<%-- jsp주석 : out은 jsp 기본객체중 하나, system.out과는 다른 객체임 --%>
<%
  out.println("<h1>스크립팅 요소중 스크립틀릿(scriptlet)</h1>");//웹 브라우저로
  for(int i = 0 ; i < 10 ; i++){
    out.print("<h3>" + i + "</h3>");
  }
  ArrayList<Blog> blogList =(ArrayList<Blog>) request.getAttribute("blogList");
  System.out.println(blogList.size());//콘솔로
  for(Blog blog : blogList){
%>
  <div class="post-preview">
    <a href="detail.do?id=<%=blog.getId()%>">
      <h2 class="post-title"><%=blog.getName()%></h2>
      <h3 class="post-subtitle"></h3>
    </a>
    <p class="post-meta">
      Posted by <%=blog.getEmail()%>
    </p>
  </div>
  <!-- Divider-->
  <hr class="my-4" />
<%
  }
%>
</body>
</html>
