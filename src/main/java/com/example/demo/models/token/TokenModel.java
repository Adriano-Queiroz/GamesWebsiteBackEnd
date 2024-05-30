package com.example.demo.models.token;

import com.example.demo.models.user.UserModel;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;

import java.util.List;

@Entity
@Getter
@Setter
@Table(name = "token")
public class TokenModel {
    @Id
    @GeneratedValue
    private Long codToken;

    @OneToMany(mappedBy = "token")
    private List<UserModel> userList;
}
