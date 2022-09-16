package iducs.jsp.b.final201812052.model;

public class Blog { // Model 객체 : dto, vo객체
    // 객체 정의 방식 : Beans, POJO(Plain Old Java Object)
    private long id;
    private String name;
    private String email;
    private String title;
    private String content;

    public long getId() {
        return id;
    }

    public void setId(long id) { this.id = id; }


    public String getName() {
        return name;
    }

    public void setName(String name) { this.name = name; }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getContent() {
        return content;
    }

    public void setContent(String content) {
        this.content = content;
    }
}
