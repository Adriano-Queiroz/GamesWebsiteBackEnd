package com.example.demo.models.token;

import com.example.demo.models.user.UserModel;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;

import java.time.Instant;
import java.util.List;
import java.util.UUID;

@Entity
@Getter
@Setter
@Table(name = "token")
public class TokenModel {
    @Id
    private String tokenValidationInfo;

    @Column
    private Instant createdAt;

    @Column
    private Instant lastUsedAt;

    @ManyToOne
    @JoinColumn(name = "codUser")
    private UserModel user;
}
