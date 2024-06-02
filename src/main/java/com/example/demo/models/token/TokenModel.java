package com.example.demo.models.token;

import com.example.demo.models.user.UserModel;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;

import java.util.List;
import java.util.UUID;

@Entity
@Getter
@Setter
@Table(name = "token")
public class TokenModel {
    @Id
    @GeneratedValue
    private Long codToken;

    @Column
    private UUID token;

    @OneToMany(mappedBy = "token")
    private List<UserModel> userList;
}
