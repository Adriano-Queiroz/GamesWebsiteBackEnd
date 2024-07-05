package com.example.demo.models.user;

import com.example.demo.models.friendship.FriendshipModel;
import com.example.demo.models.user.role.UserRoleModel;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;
import com.example.demo.models.token.TokenModel;
import com.example.demo.models.battle.BattleModel;
import org.springframework.scheduling.annotation.Scheduled;

import java.time.LocalDate;
import java.time.LocalDateTime;
import java.util.Objects;

import java.util.ArrayList;
import java.util.List;

@Entity

@Table(name = "user",
uniqueConstraints = {
        @UniqueConstraint(columnNames = "username"),
        @UniqueConstraint(columnNames = "email")
}
)
public class UserModel {

    @Id
    @GeneratedValue
    @Getter
    @Setter
    private Long codUser;

    @Column(unique = true, nullable = false)
    @Getter
    @Setter
    private String username;

    @Column(unique = true, nullable = false)
    @Getter
    @Setter
    private String email;

    @Getter
    @Setter
    private String passwordValidationInfo;

    @Getter
    @Setter
    private String password;

    @Getter
    @Setter
    private Long cpf;

    @Getter
    @Setter
    private String phoneNumber;

    @Getter
    private String forgotPasswordCode;
    public void setForgotPasswordCode(String forgotPasswordCode) {
        this.forgotPasswordCode = forgotPasswordCode;
        this.forgotPasswordCodeDate = LocalDateTime.now();
    }
    @Scheduled(fixedDelay = 60 * 60 * 1000) // Check every hour
    private void clearExpiredPasswordCodes() {
        if (forgotPasswordCodeDate != null && forgotPasswordCodeDate.plusHours(1).isBefore(LocalDateTime.now())) {
            this.forgotPasswordCode = null;
            this.forgotPasswordCodeDate = null;
        }
    }

    @Getter
    @Setter
    private int emailsSentInTheLastHour;
    @Getter
    @Setter
    private LocalDateTime forgotPasswordCodeDate;

    @ManyToOne
    @JoinColumn(name = "cod_user_role")
    @Getter
    @Setter
    private UserRoleModel userRole;

    @OneToMany(mappedBy = "user", cascade = CascadeType.ALL, orphanRemoval = true)
    @Getter
    @Setter
    private List<TokenModel> tokens = new ArrayList<>();

    @Getter
    @Setter
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
