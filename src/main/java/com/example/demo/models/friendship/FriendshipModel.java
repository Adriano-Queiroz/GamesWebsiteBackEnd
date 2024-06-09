package com.example.demo.models.friendship;

import com.example.demo.models.user.UserModel;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;

@Entity
@Table(name = "friendship")
@Getter
@Setter
public class FriendshipModel {
    @Id
    @GeneratedValue
    private Long id;

    @ManyToOne
    @JoinColumn(name = "cod_user_request")
    private UserModel userRequest; // who sent request

    @ManyToOne
    @JoinColumn(name = "cod_user_accept")
    private UserModel userAccept; // who accepted request

    private Boolean isAccepted;

}
