package com.example.demo.models.user;

import com.example.demo.models.friendship.FriendshipModel;
import com.example.demo.models.user.role.UserRoleModel;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;
import com.example.demo.models.token.TokenModel;
import com.example.demo.models.battle.BattleModel;

import java.util.ArrayList;
import java.util.List;

@Entity
@Getter
@Setter
@Table(name = "user")
public class UserModel {

    @Id
    @GeneratedValue
    private Long codUser;

    @ManyToOne
    @JoinColumn(name = "cod_user_role")
    private UserRoleModel userRole;

    @ManyToOne
    @JoinColumn(name = "cod_token")
    private TokenModel token;

    @OneToMany(mappedBy = "codUserRequest")
    private List<FriendshipModel> sentFriendshipRequests;

    @OneToMany(mappedBy = "codUserAccept")
    private List<FriendshipModel> receivedFriendshipRequests;

    @ManyToMany(mappedBy = "users") // mappedBy refers to the field name in MatchModel
    private List<BattleModel> battles = new ArrayList<>();
}
