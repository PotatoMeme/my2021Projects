<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="../main/index.jsp">KSH's Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
             <ul class="navbar-nav ms-auto py-4 py-lg-0">
                 <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="../blogs/list.do?pn=1">List</a></li>
                 <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="../blogs/sort.do?by=1-1">Sort and Page</a></li>
                 <c:choose>
                     <c:when test="${sessionScope.logined == null}">
                         <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="../bloggers/login-form.do">Login</a></li>
                         <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="../bloggers/register-form.do">Register</a></li>
                     </c:when>
                     <c:otherwise>
                         <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="../blogs/postForm.jsp">Post</a></li>

                         <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="../bloggers/detail.do?id=${logined.id}">Info</a></li>
                         <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="../bloggers/logout.do">Logout</a></li>
                     </c:otherwise>
                 </c:choose>
                 <c:choose>
                     <c:when test="${sessionScope.logined.rank == 1}">
                         <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="../bloggers/list.do?by=1-1">MemberList</a></li>
                     </c:when>

                 </c:choose>
            </ul>

        </div>
    </div>
</nav>