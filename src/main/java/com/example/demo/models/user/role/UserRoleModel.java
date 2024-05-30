package com.example.demo.models.user.role;

import com.example.demo.models.user.UserModel;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;
import java.util.List;

@Entity
@Getter
@Setter
@Table(name = "user_role")
public class UserRoleModel {
    @Id
    @GeneratedValue
    private Long codUserRole;

    @OneToMany(mappedBy = "userRole")
    private List<UserModel> userList;

}
