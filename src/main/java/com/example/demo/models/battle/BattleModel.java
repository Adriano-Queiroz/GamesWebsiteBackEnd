package com.example.demo.models.battle;

import com.example.demo.models.user.UserModel;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;

import java.util.HashSet;
import java.util.Set;

@Entity
@Table(name = "battle")
@Getter
@Setter
public class BattleModel {

    @Id
    private Long codBattle;

    @ManyToMany
    @JoinTable(
            name = "user_battle", // Creating a join table
            joinColumns = @JoinColumn(name = "cod_battle"),
            inverseJoinColumns = @JoinColumn(name = "cod_user")
    )
    private Set<UserModel> users = new HashSet<>();
    //adicionar game
    //
}
