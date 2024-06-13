package com.example.demo.models.user;

import com.example.demo.models.friendship.FriendshipModel;
import com.example.demo.models.user.role.UserRoleModel;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;
import com.example.demo.models.token.TokenModel;
import com.example.demo.models.battle.BattleModel;
import java.util.Objects;

import java.util.ArrayList;
import java.util.List;

@Entity
@Getter
@Setter
@Table(name = "user",
uniqueConstraints = {
        @UniqueConstraint(columnNames = "username"),
        @UniqueConstraint(columnNames = "email")
}
)
public class UserModel {

    @Id
    @GeneratedValue
    private Long codUser;

    private String username;

    private String email;

    private String passwordValidationInfo;

    @ManyToOne
    @JoinColumn(name = "cod_user_role")
    private UserRoleModel userRole;

    @OneToMany(mappedBy = "user", cascade = CascadeType.ALL, orphanRemoval = true)
    private List<TokenModel> tokens = new ArrayList<>();

    //@OneToMany(mappedBy = "codUserRequest")
    //private List<FriendshipModel> sentFriendshipRequests;

    //@OneToMany(mappedBy = "codUserAccept")
    //private List<FriendshipModel> receivedFriendshipRequests;
/*
    @ManyToMany(mappedBy = "users") // mappedBy refers to the field name in MatchModel
    private List<BattleModel> battles = new ArrayList<>();

 */
    private double balance;

    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;
        UserModel userModel = (UserModel) o;
        return codUser != null && codUser.equals(userModel.codUser);
    }

    @Override
    public int hashCode() {
        return Objects.hash(codUser);
    }

}
